<template>
<el-container>
  <el-main>
  <template v-for="item in article">
    <el-card class="box-card" shadow="always" :key="item.key">
    <div slot="header" class="clearfix">
      <el-button style="float: left; padding: 3px 0" type="text">{{item.type | type}}</el-button>
        <span>{{item.title}}</span>
        <el-button style="float: right; padding: 3px 0" type="text">{{item.create_time}}</el-button>
    </div>
    <div class="text item" @click="showdetail(item.id)">
        {{item.content}}
        <el-button style="float: right; padding: 3px 0" type="text" :id="item.id" >查看详情</el-button>
    </div>
    </el-card>
 </template>
  <el-pagination @current-change="handleCurrentChange" background layout="prev, pager, next" :total=total :page-size="4"></el-pagination>
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
import eventVue from '../model/eventVue.js'
export default {
    data() {
      return {
        article: {},
        page: "",
        total: 1000,
        type: "1-0",
      }
    },
    mounted: function(){
        eventVue.$on("myFun",(message)=>{
           this.type = message; 
           this.btn();
      })

      
        this.btn();
    },
    methods: {
      handleCurrentChange(val) {
        this.page = val;
        this.$http.get('http://api.lxb.cc/blogs?page=' + this.page + '&type=' + this.type ,{emulateJSON: true}).then(function(res){
          this.article = res.data.info;
        })
      },
      showdetail(id){
        window.open('http://localhost:8080/detail?id=' + id);
      },
      btn() {
        this.$http.get('http://api.lxb.cc/blogs?page=1&type=' + this.type,{emulateJSON: true}).then(function(res){
          this.article = res.data.info;
          this.total = res.data.num;
        })
      },
    },
    filters:{
      type:function(value){
        switch(value){
          case 1: return 'Vue';
          case 2: return 'Jquery';
          case 3: return 'Nodejs';
          case 4: return 'TP3';
          case 5: return 'TP5';
          case 6: return 'Linux';
          case 7: return 'Xshell';
          case 8: return 'Docker';
          case 9: return 'ES6';
          case 10: return '正则';
          case 11: return 'Webpack';
          case 12: return 'Git';
          default: return 'NONE';
        }
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

