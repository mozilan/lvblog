/*
|-------------------------------------------------------------------------------
| VUEX modules/common.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Blog Styles
*/

export const common = {
    state: {
        simplifyStatus:0,
        gorgeousStatus:0,
        //分类
        blog: {
            gorgeous_art:{
                body:{
                    padding:'8px'
                },
                title:{
                    marginTop:'5px',
                    marginBottom:'0'
                },
                time:{
                    display:'block'
                },
                simple_time:{
                    display:'none'
                },
                image:{
                    display:'block'
                },
                read:{
                  display:'block'
                },
                simple_read:{
                   display:'none'
                },
                abstract:{
                    marginTop:'0',
                    marginBottom:'0',
                    backgroundColor:'white'
                },
                art_body:{
                    padding:'10px 0'
                }
            },
            simplify_art:{
                body:{
                    padding:'8px'
                },
                title:{
                    marginTop:'5px',
                    marginBottom:'5px'
                },
                time:{
                    display:'none'
                },
                simple_time:{
                    display:'block'
                },
                image:{
                    display:'none'
                },
                read:{
                    display:'none'
                },
                simple_read:{
                    customStylesor:'orange',
                    display:'block'
                },
                abstract:{
                    margin:'10px 0',
                    backgroundColor:'#f4f4f4'
                },
                art_body:{
                    padding:'0'
                }
            },
            art:{
                body:{
                    padding:'8px'
                },
                title:{

                },
                time:{

                },
                simple_time:{
                    display:'none'
                },
                image:{

                },
                read:{

                },
                simple_read:{
                    display:'none'
                },
                abstract:{

                },
                art_body:{}
            }
        },
        last_path:'',
        edit:{
            customStyles:{
                col:{
                    width:'100%',
                    padding:'0 20px'
                },
                bread:{
                    width:'100%',
                    padding:'0 25px'
                },
            },
            styles:{

            }
        }

    },
    actions:{
        simplify({commit,state}){
            commit('setBlogArt',state.blog.simplify_art);
            commit('setGorgeousStatus',0);
            commit('setSimplifyStatus',2);
        },
        gorgeous({commit,state}){
            // if(window.innerWidth < 683){
            //     commit('setSmallBlogArt',state.blog.gorgeous_art);
            // }else{
            commit('setBlogArt',state.blog.gorgeous_art);
            commit('setGorgeousStatus',2);
            commit('setSimplifyStatus',0);
        },
        setLastPath({commit},data){
            commit('setLastPath',data.params);
        },
        fullScreenEditor({commit,state}){
            commit('setScreenEditor',state.edit.customStyles);
        },
        cancelScreenEditor({commit}){
            commit('setScreenEditor','');
        },
    },
    mutations:{
        setBlogArt(state,data){
            state.blog.art = data;
        },
        setGorgeousStatus(state,status){
            state.gorgeousStatus = status;
        },
        setSimplifyStatus(state,status){
            state.simplifyStatus = status;
        },
        // setSmallBlogArt(state,data){
        //     let dataCopy = data;
        //     dataCopy.simple_time.display = 'none';
        //     dataCopy.simple_read.display = 'none';
        //     console.log(dataCopy.simple_time,dataCopy.simple_read);
        //     state.blog.art = dataCopy;
        // },
        setLastPath(state,params){
            state.last_path = params;
        },
        setScreenEditor(state,params){
            state.edit.styles = params;
        },
    },
    getters:{
        getArticleShowModel(state){
            return state.blog.art;
        },
        getGorgeousStatus(state){
            return state.gorgeousStatus;
        },
        getSimplifyStatus(state){
            return state.simplifyStatus;
        },
        setLastPath(state){
            return state.last_path;
        },
        getScreenEditor(state){
            return state.edit;
        },
    }
};