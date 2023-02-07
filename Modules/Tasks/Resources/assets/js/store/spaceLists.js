import axiosIns from "./../libs/axios"

// initial state
const state = () => ({

    lists: [],
    paginationDataMeta:{
        total:0,
        current_page:1,
        from:0,
        to:0,
    },
    Office: {},
    isLoading: false,
})

// getters
const getters = {
    lists: state => state.lists,
    paginationData: state => state.paginationDataMeta,
    Office: state => state.Office,
    isLoading: state => state.isLoading,
};

// actions
const actions = {

    async fetchAllworkspaceLists({ commit }, id = null) {
        await axiosIns.post('/tasks/space_tasks_lists', {
                workspace_id: id
            })
            .then(res => {
                const resData = res.data.data;
                commit('lists', resData.data);
            }).catch(err => {
            });
    },

    async fetchOffice({ commit }, id = null) {
        await axiosIns.get(`/admin/offices/${id}`)
            .then(res => {
                const resData = res.data.data;
                commit('setOffice', resData);
            }).catch(err => {
                console.log('error', err);
            });
    },

    storeOffice(ctx, OfficeData) {
        return new Promise((resolve, reject) => {
            axiosIns
                .post('/admin/offices', OfficeData)
                .then(response => resolve(response.data))
                .catch(error => reject(error))
        })
    },

    updateOffice(ctx,OfficeData) {
        return new Promise((resolve, reject) => {
            axiosIns.put(`/admin/offices/${OfficeData.id}`, OfficeData)
                .then(response => resolve(response.data))
                .catch(error => reject(error))
        })
    },

    deleteOffice(ctx,id) {
        return new Promise((resolve, reject) => {
            axiosIns.delete(`/admin/offices/${id}`)
                .then(response => resolve(response.data))
                .catch(error => reject(error))
        })
    },

}

// mutations
const mutations = {

    setOffices: (state, Offices) => {
        state.Offices = Offices
    },

    setpaginationData: (state, pagin) => {
        state.paginationDataMeta = pagin
    },

    setOffice: (state, Office) => {
        state.Office = Office
    },

    setOfficeIsLoading(state, isLoading) {
        state.isLoading = isLoading
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
