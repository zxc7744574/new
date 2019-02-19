<template>
  <el-container>
    <el-header>
      <el-row style="margin-bottom:10px;">{{name}}</el-row>
      <el-row>作者：{{title}}&nbsp;&nbsp;发布日期：{{createtime}}</el-row>
    </el-header>
    <el-main>{{content}}</el-main>
  </el-container>
</template>

<script>
  export default {
    data() {
      return {
        name: "",
        title: "",
        content: "",
        createtime: "",
      }
    },
    mounted: function(){
      var id = this.$route.query.id;
      this.$http.get('http://api.lxb.cc/index/blog/show?id='+ id,{emulateJSON: true}).then(function(res){
        this.name = res.data.name;
        this.title = res.data.title;
        this.content = res.data.content;
        this.createtime = res.data.create_time;
      })
    }
  }
</script>

<style>
  .el-header, .el-footer {
    /* background-color: #B3C0D1; */
    color: #333;
    text-align: center;
    line-height: 30px;
    margin-top:50px;
  }
  
  .el-main {
    /* background-color: #E9EEF3; */
    color: #333;
    text-align: center;
    line-height: 10px;
    margin-top:50px;
    margin-bottom:50px;
  }
  
  body > .el-container {
    margin-bottom: 40px;
  }
  
  .el-container:nth-child(5) .el-aside,
  .el-container:nth-child(6) .el-aside {
    line-height: 260px;
  }
  
  .el-container:nth-child(7) .el-aside {
    line-height: 320px;
  }
</style>

