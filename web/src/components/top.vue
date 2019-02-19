<template>
    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
    <el-menu-item index="1-0"><router-link to="/index">首页</router-link></el-menu-item>
    <el-submenu index="2">
        <template slot="title">前端</template>
        <el-menu-item index="2-1"><router-link to="/vue">Vue</router-link></el-menu-item>
        <el-menu-item index="2-2"><router-link to="/jquery">Jquery</router-link></el-menu-item>
        <el-menu-item index="2-3"><router-link to="/nodejs">Node.js</router-link></el-menu-item>
    </el-submenu>
    <el-submenu index="3">
        <template slot="title">后端</template>
        <el-menu-item index="3-4"><router-link to="/tp3">TP3</router-link></el-menu-item>
        <el-menu-item index="3-5"><router-link to="/tp5">TP5</router-link></el-menu-item>
    </el-submenu>
    <el-submenu index="4">
        <template slot="title">Linux</template>
        <el-menu-item index="4-6"><router-link to="/linux">Linux</router-link></el-menu-item>
        <el-menu-item index="4-7"><router-link to="/xshell">Xshell</router-link></el-menu-item>
        <el-menu-item index="4-8"><router-link to="/docker">Docker</router-link></el-menu-item>
    </el-submenu>
    <el-submenu index="5">
        <template slot="title">相关</template>
        <el-menu-item index="5-9"><router-link to="/es6">ES6</router-link></el-menu-item>
        <el-menu-item index="5-10"><router-link to="/zz">正则</router-link></el-menu-item>
        <el-menu-item index="5-11"><router-link to="/webpack">Webpack</router-link></el-menu-item>
        <el-menu-item index="5-12"><router-link to="/git">Git</router-link></el-menu-item>
    </el-submenu>
      <el-menu-item index="6" style="float:right;"><router-link to="/register">注册</router-link></el-menu-item>
      <el-menu-item index="7" style="float:right;"><router-link to="/login">登录</router-link></el-menu-item>
    </el-menu>
</template>

<script>
import eventVue from '../model/eventVue.js'
  export default {
    data() {
      return {
        activeIndex: '1',
        activeIndex2: '1',
        msg: '1',
      };
    },
    methods: {
      handleSelect(key, keyPath) {
        // this.$http.get('http://api.lxb.cc/blogs?page=1&key=' + key,{emulateJSON: true}).then(function(res){
          //传输对应页签的数据
          eventVue.$emit("myFun",key);
        // })
      },
    }
  }
</script>

<style>
a {
  text-decoration: none;
  color: grey;
}
.router-link-active {
    text-decoration: none;
}
</style>


