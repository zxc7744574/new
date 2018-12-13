<template>
<el-container>
  <el-main>

  <template v-for="item in article">
    <el-card class="box-card" shadow="always" :key="item.key">
    <div slot="header" class="clearfix">
        <span>{{item.title}}</span>
        <el-button style="float: right; padding: 3px 0" type="text">{{item.create_time}}</el-button>
    </div>
    <div class="text item">
        {{item.content}}
        <el-button style="float: right; padding: 3px 0" type="text">查看详情</el-button>
    </div>
    </el-card>
 </template>
  <el-pagination @current-change="handleCurrentChange" background layout="prev, pager, next" :total="12" :page-size="4"></el-pagination>
  </el-main>
  <el-aside width="30%">
    <el-card :body-style="{ padding: '0px' }">
      <img src="@/assets/icon.png" class="image">
      <div style="padding: 14px;">
        <p>Author:  Bug Luv</p>
        <p style="font-size:13px;color:grey;"> Info：  乐天派！</p>
        <p><img src="@/assets/github.png" class="image">&nbsp;&nbsp;<img src="@/assets/qq.png" class="image">&nbsp;&nbsp;<img src="@/assets/sina.png" class="image"></p>
      </div>
    </el-card>
  </el-aside>
</el-container>
</template>

<script>
export default {
    data() {
      return {
        article: {},
        page: "",
      }
    },
    mounted: function(){
      this.$http.get('http://api.lxb.cc/blogs?page=1',{emulateJSON: true}).then(function(res){
        this.article = res.data;
      })
    },
    methods: {
      handleCurrentChange(val) {
        this.page = val;
        this.$http.get('http://api.lxb.cc/blogs?page=' + this.page,{emulateJSON: true}).then(function(res){
          this.article = res.data;
        })
      }
    }
}
</script>

<style>
  
  .el-aside {
    background-color: #D3DCE6;
    color: #333;
    text-align: center;
    margin-top:50px;
  }
  
  .el-main {
    background-color: #E9EEF3;
    color: #333;
    text-align: center;
    margin-top:50px;
  }
  
    .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }

  .box-card {
    width: 100%;
    margin-bottom: 30px;
  }

  .el-alert {
    margin-top: 30px;
  }
  
</style>

