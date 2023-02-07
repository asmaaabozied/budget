<!-- Scripts and styles , with customized vite directive -->
{{
    Vite::useHotFile(storage_path('vite.hot'))
        ->useBuildDirectory('build-main')
        ->useManifestFilename('main_manifest.json')
        ->withEntryPoints(['resources/assets/js/app.js'])
}}