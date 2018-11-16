<template>
    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
    <el-menu-item index="1"><router-link to="/index">首页</router-link></el-menu-item>
    <el-submenu index="2">
        <template slot="title">前端</template>
        <el-menu-item index="2-1"><router-link to="/index">Vue</router-link></el-menu-item>
        <el-menu-item index="2-2"><router-link to="/index">Jquery</router-link></el-menu-item>
        <el-menu-item index="2-3"><router-link to="/index">Node.js</router-link></el-menu-item>
    </el-submenu>
    <el-submenu index="3">
        <template slot="title">后端</template>
        <el-menu-item index="3-1"><router-link to="/index">TP3</router-link></el-menu-item>
        <el-menu-item index="3-2"><router-link to="/index">TP5</router-link></el-menu-item>
    </el-submenu>
    <el-submenu index="4">
        <template slot="title">Linux</template>
        <el-menu-item index="4-1"><router-link to="/index">Linux</router-link></el-menu-item>
        <el-menu-item index="4-2"><router-link to="/index">Xshell</router-link></el-menu-item>
        <el-menu-item index="4-3"><router-link to="/index">Docker</router-link></el-menu-item>
    </el-submenu>
    <el-submenu index="5">
        <template slot="title">相关</template>
        <el-menu-item index="5-1"><router-link to="/index">ES6</router-link></el-menu-item>
        <el-menu-item index="5-2"><router-link to="/index">正则</router-link></el-menu-item>
        <el-menu-item index="5-3"><router-link to="/index">Webpack</router-link></el-menu-item>
        <el-menu-item index="5-3"><router-link to="/index">Git</router-link></el-menu-item>
    </el-submenu>
      <el-menu-item index="6" style="float:right;"><router-link to="/register">注册</router-link></el-menu-item>
      <el-menu-item index="7" style="float:right;"><router-link to="/login">登录</router-link></el-menu-item>
    </el-menu>
</template>

<script>
  export default {
    data() {
      return {
        activeIndex: '1',
        activeIndex2: '1'
      };
    },
    methods: {
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>

<style>
.router-link-active {
    text-decoration: none;
}
</style>


