<template>
<el-row>
  <el-col :span="6"><div class="grid-content"></div></el-col>
  <el-col :span="12">
    <div class="grid-content bg-purple-light" >
      <div style="display:table;margin:0 auto;margin-top:40px;padding-top:40px;">
        <img alt="Vue logo" src="../assets/icon.png" style="vertical-align:middle;">
        <span style="font-size:36px;vertical-align:middle;margin-left:15px;">Registration</span>
      </div>
      <el-form :model="ruleform" status-icon :rules="rules1" ref="ruleform" label-width="80px" style="display:table;margin:0 auto;margin-top:40px;margin-bottom:40px;padding-bottom:40px;">
        <el-form-item label="账号" prop="acc" style="width:400px;">
          <el-input v-model="ruleform.acc"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="pass" style="width:400px;">
          <el-input v-model="ruleform.pass" type="password" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="确认密码" prop="checkpass" style="width:400px;">
          <el-input v-model="ruleform.checkpass" type="password" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="submitForm('ruleform')" style="display:table;margin:0 auto;">立即注册</el-button>
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
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else {
          if (this.ruleform.checkpass !== '') {
            this.$refs.ruleform.validateField('checkpass');
          }
          callback();
        }
      };
      var validatePass3 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'));
        } else if (value !== this.ruleform.pass) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }
      };
      return {
        ruleform: {
          acc: '',
          pass: '',
          checkpass: '',
        },
        rules1: {
          acc:[
            { required: true, message: '账号不得为空', trigger: 'blur' },
            { min: 6, max: 12, message: '长度在 6 到 12 个字符', trigger: 'blur' }
            ],
          pass:[
            { required: true, validator: validatePass2, trigger: 'blur' },
            { min: 6, max: 12, message: '长度在 6 到 12 个字符', trigger: 'blur' }
            ],
          checkpass:[
            { required: true, validator: validatePass3, trigger: 'blur' }
            ],
        },
      }
    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.$http.post('http://api.lxb.cc/index/blog/addform',{info:this.ruleform},{emulateJSON: true}).then(function(res){
              if(res){
                this.$alert('账号创建成功',' ',{
                  confirmButtonText: '确定',
                  callback: action => {
                    this.$message({
                      type: 'info',
                      message: `action: ${action}账号已创建，请直接登录`
                    });
                   setTimeout(function(){ window.location.href= "http://localhost:8080/login"; }, 1500);
                  }
                });
              }else {
                alert('已存在重复账号');
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

