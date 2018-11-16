<template>
<el-row>
  <el-col :span="6"><div class="grid-content"></div></el-col>
  <el-col :span="12">
    <div class="grid-content bg-purple-light" >
      <div style="display:table;margin:0 auto;margin-top:40px;padding-top:40px;">
        <img alt="Vue logo" src="../assets/icon.png" style="vertical-align:middle;">
        <span style="font-size:36px;vertical-align:middle;margin-left:15px;">Bug Luv</span>
      </div>
      <el-form ref="form" :model="form" label-width="80px" style="display:table;margin:0 auto;margin-top:40px;margin-bottom:40px;padding-bottom:40px;">
        <el-form-item label="账号" style="width:400px;">
          <el-input v-model="form.acc"></el-input>
        </el-form-item>
        <el-form-item label="密码" style="width:400px;">
          <el-input v-model="form.pwd" type="password"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit" style="display:table;margin:0 auto;">登录</el-button>
        </el-form-item>
      </el-form>
    </div>
  </el-col>
  <el-col :span="6"><div class="grid-content"></div></el-col>
</el-row>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          acc: '',
          pwd: '',
        },
      }
    },
    methods: {
      onSubmit() {
        console.log('submit!');
      }
    }
  }
</script>

<style>
  .el-row {
    margin-bottom: 20px;
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
</style>

