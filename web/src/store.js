import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    currentUser: null,  //当前用户
    isLogin: false,   //登录状态
  },
  //更改 Vuex 的 store 中的状态的唯一方法是提交 mutation。
  //每个 mutation 都有一个字符串的 事件类型 (type) 和 一个 回调函数 (handler)。
  //要唤醒一个 mutation handler，你需要以相应的 type 调用 store.commit 方法
  //mutation 都是同步事务
  mutations: {
    userStatus (state,user) {
      if(user) { //登录
        state.currentUser = user
        state.isLogin = true
      }else if(user == null){ //登出
        sessionStorage.setItem('userName',null);
        state.currentUser = null;
        state.isLogin = false;
      }
    }
  },
  //Action 提交的是 mutation，而不是直接变更状态。
  //Action 可以包含任意异步操作。
  //Action 通过 store.dispatch 方法触发
  actions: {
    setUser ({commit},user) {
      commit("userStatus",user)
    }
  },
  //需要从store中的state中派生出一些状态，可以认为是 store 的计算属性
  //Getter 会暴露为 store.getters 对象
  getters: {
    currentUser : state => state.currentUser,
    isLogin : state => state.isLogin
  }
})
