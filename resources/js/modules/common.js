/*
|-------------------------------------------------------------------------------
| VUEX modules/common.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Blog Styles
*/

export const common = {
    state: {
        //分类
        blog: {
            gorgeous_art:{
                body:{
                    padding:'20px'
                },
                title:{
                    marginTop:'15px',
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
                    padding:'10px'
                },
                title:{
                    marginTop:'0',
                    marginBottom:'10px'
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
                    color:'orange',
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
                    padding:'20px'
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

    },
    actions:{
        simplify({commit,state}){
            commit('setBlogArt',state.blog.simplify_art)
        },
        gorgeous({commit,state}){
            // if(window.innerWidth < 683){
            //     commit('setSmallBlogArt',state.blog.gorgeous_art);
            // }else{
            commit('setBlogArt',state.blog.gorgeous_art);

        }
    },
    mutations:{
        setBlogArt(state,data){
            state.blog.art = data;
        },
        // setSmallBlogArt(state,data){
        //     let dataCopy = data;
        //     dataCopy.simple_time.display = 'none';
        //     dataCopy.simple_read.display = 'none';
        //     console.log(dataCopy.simple_time,dataCopy.simple_read);
        //     state.blog.art = dataCopy;
        // },
    },
    getters:{
        getArticleShowModel(state){
            return state.blog.art;
        },
    }
};