<template>
<el-container>
  <el-main>
    <el-card class="box-card" shadow="always">
    <div slot="header" class="clearfix">
        <span>我是文章标题</span>
        <el-button style="float: right; padding: 3px 0" type="text">查看详情</el-button>
    </div>
    <div class="text item">
        我是文章内容
    </div>
    </el-card>
    <el-card class="box-card" shadow="always">
    <div slot="header" class="clearfix">
        <span>我是文章标题</span>
        <el-button style="float: right; padding: 3px 0" type="text">查看详情</el-button>
    </div>
    <div class="text item">
        我是文章内容
    </div>
    </el-card>
    <el-card class="box-card" shadow="always">
    <div slot="header" class="clearfix">
        <span>我是文章标题</span>
        <el-button style="float: right; padding: 3px 0" type="text">查看详情</el-button>
    </div>
    <div class="text item">
        我是文章内容
    </div>
    </el-card>
  </el-main>
  <el-aside width="30%">
  <el-alert
    title="成功提示的文案"
    type="success"
    description="文字说明文字说明文字说明文字说明文字说明文字说明"
    show-icon :closable="false">
  </el-alert>
  <el-alert
    title="消息提示的文案"
    type="info"
    description="文字说明文字说明文字说明文字说明文字说明文字说明"
    show-icon :closable="false">
  </el-alert>
  <el-alert
    title="警告提示的文案"
    type="warning"
    description="文字说明文字说明文字说明文字说明文字说明文字说明"
    show-icon :closable="false">
  </el-alert>
  <el-alert
    title="错误提示的文案"
    type="error"
    description="文字说明文字说明文字说明文字说明文字说明文字说明"
    show-icon :closable="false">
  </el-alert>
  </el-aside>
</el-container>
</template>

<script>
export default {
    
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

