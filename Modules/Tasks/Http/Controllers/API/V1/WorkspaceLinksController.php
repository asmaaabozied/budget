<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Responses\JsonResponse;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Criteria\WorkSpaceLinksCriteria;
use Modules\Tasks\Http\Requests\workspaceLinkCreateRequest;
use Modules\Tasks\Http\Requests\WorkspaceLinkUpdateRequest;
use Modules\Tasks\Interfaces\WorkspaceLinkRepository;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class WorkspaceLinksController.
 */
class WorkspaceLinksController extends Controller
{
    /**
     * @var WorkspaceLinkRepository
     */
    protected $repository;

    /**
     * WorkspaceLinksController constructor.
     *
     * @param  WorkspaceLinkRepository  $repository
     * @param  WorkspaceLinkValidator  $validator
     */
    public function __construct(WorkspaceLinkRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $workspace_id)
    {
        $this->repository->pushCriteria(app(WorkSpaceLinksCriteria::class));
        $workspaceLinks = $this->repository->all();

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $workspaceLinks,
            ]);
        }

        return view('workspaceLinks.index', compact('workspaceLinks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  workspaceLinkCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(workspaceLinkCreateRequest $request)
    {
        try {
            $validated = $request->only(['name', 'link', 'icon', 'icon_color', 'space_id', 'parent_id', 'notes', 'created_by']);
            $createdWorkspaceLink = $this->repository->create($validated);
            $workspaceLink = $this->repository->whereId($createdWorkspaceLink['data']['id'])->with(['parent', 'subLinks', 'workspace'])->first();

            $response = [
                'message' => 'Link created.',
                'data' => $workspaceLink,
            ];

            if ($request->expectsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $workspaceLink = $this->repository->find($id);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $workspaceLink,
            ]);
        }

        return view('workspaceLinks.show', compact('workspaceLink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workspaceLink = $this->repository->find($id);

        return view('workspaceLinks.edit', compact('workspaceLink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  WorkspaceLinkUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(WorkspaceLinkUpdateRequest $request, $id)
    {
        try {
            $validated = $request->only(['name', 'link', 'icon', 'icon_color', 'space_id', 'parent_id', 'notes', 'edited_by']);
            $updatedWorkspaceLink = $this->repository->update($validated, $id);
            $workspaceLink = $this->repository->whereId($updatedWorkspaceLink['data']['id'])->with(['parent', 'subLinks', 'workspace'])->first();

            $response = [
                'message' => 'Link updated.',
                'data' => $workspaceLink,
            ];

            if (request()->expectsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spaceLink = $this->repository->whereId($id)->first();
        $workspaceId = $spaceLink->space_id;

        $isAuthorized = Auth::user()->ability(['Super Admin'], ['delete_workspace_links'])
            || in_array($workspaceId, Auth::user()->ownerWorkspaces->pluck('id')->toArray());

        if (! $isAuthorized) {
            if (request()->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $deleted = $this->repository->delete($id);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Workspace Link deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'WorkspaceLink deleted.');
    }
}
