<template>
<el-card class="box-card">
  <div slot="header" class="clearfix">
    <span>个人信息</span>
  </div>
  <el-row>
    <el-col :span="12">
      <div class="grid-content">
        <img src="@/assets/icon.png">
        <p>所属用户组：超级管理员</p>
        <p>上次登录IP：192.168.1.1</p>
        <p>上次登录时间：2018/11/22 18:05</p>
      </div>
    </el-col>
    <el-col :span="12">
      <div class="grid-content">
        <p>Bug Luv</p>
      <div v-if="7 <= time && time <= 12">
        上午好,每个早晨都是全新一天的开始，祝早安。
      </div>
      <div v-else-if="12 < time && time <= 18">
        下午好，喝杯茶吧，让精神抖擞起来。
      </div>
      <div v-else>
        晚上好，祝美梦，晚安。
      </div>
      </div>
    </el-col>
  </el-row>
</el-card>
</template>

<script>
var myDate = new Date();

export default {
  data(){
    return {
      time:myDate.getHours(),

    }
  }
}
</script>


<style>
  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }
  .box-card {
    margin:0 auto;
    margin-top:20px;
    width: 80%;
  }

  .grid-content {
    border-radius: 4px;
    min-height: 36px;
    text-align: center;
  }
</style>

