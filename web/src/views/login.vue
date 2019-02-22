<template>
<el-row>
  <el-col :span="6"><div class="grid-content"></div></el-col>
  <el-col :span="12">
    <div class="grid-content bg-purple-light" >
      <div style="display:table;margin:0 auto;margin-top:40px;padding-top:40px;">
        <img alt="Vue logo" src="../assets/icon.png" style="vertical-align:middle;">
        <span style="font-size:36px;vertical-align:middle;margin-left:15px;">Login</span>
      </div>
      <el-form ref="form" :model="form" status-icon :rules="rules" label-width="80px" style="display:table;margin:0 auto;margin-top:40px;margin-bottom:40px;padding-bottom:40px;">
        <el-form-item label="账号" prop="acc" style="width:400px;">
          <el-input v-model="form.acc"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="pwd" style="width:400px;">
          <el-input v-model="form.pwd" type="password"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="submitForm('form')" style="display:table;margin:0 auto;">登录</el-button>
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
        rules: {
          acc:[
              { required: true, message: '账号不得为空', trigger:'blur' },
              { min: 6, max: 12, message: '账号长度在6-12位之间', trigger:'blur' },
            ],
          pwd:[
              { required: true, message: '密码不得为空', trigger:'blur' },
              { min: 6, max: 12, message: '密码长度在6-12位之间', trigger:'blur' },
            ]
        }
      }
    },
    mounted: function(){

    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.$http.post('http://api.lxb.cc/index/blog/checkinfo',{info:this.form},{emulateJSON: true}).then(function(res){
              if(res.data != 2){
                  // this.$message({ type: 'success', message: '登录成功' });
                  sessionStorage.setItem("userName",res.data.name);
                  // sessionStorage.setItem("userToken",res.data.token);
                  this.$store.dispatch("setUser",res.data.name);
                  // this.$store.dispatch("setToken",res.data.token);
                  console.log(this.$store.state.isLogin);
                  this.$router.push({path:'/'});
              }else {
                  this.$message.error('账号或密码错误');
              }
            })
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
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

