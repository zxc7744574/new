<template>
<div id="nav">
<van-nav-bar title="首页" />

<van-swipe :autoplay="3000">
  <van-swipe-item><img src="@/assets/fire.png"></van-swipe-item>
  <van-swipe-item><img src="@/assets/ling.png"></van-swipe-item>
  <van-swipe-item><img src="@/assets/cloud.png"></van-swipe-item>
  <van-swipe-item><img src="@/assets/phone.png"></van-swipe-item>
</van-swipe>

<van-row>
  <van-col span="8"><img src="@/assets/idea.png"><p>技术文章</p></van-col>
  <van-col span="8"><img src="@/assets/note.png"><p>技术文章</p></van-col>
  <van-col span="8"><img src="@/assets/rain.png"><p>技术文章</p></van-col>
</van-row>

<van-panel title="标题1" desc="2018.11.23" status="科技" style="margin-bottom:20px;">
    <div class="van-ellipsis">我是内容</div>
</van-panel>
<van-panel title="标题2" desc="2018.11.24" status="生活" style="margin-bottom:20px;">
    <div class="van-ellipsis">我是内容</div>
</van-panel>
<van-panel title="标题3" desc="2018.11.25" status="个人" style="margin-bottom:20px;">
    <div class="van-ellipsis">我是内容</div>
</van-panel>

<van-tabbar>
  <van-tabbar-item icon="shop">首页</van-tabbar-item>
  <van-tabbar-item icon="records" info="5">文章</van-tabbar-item>
  <van-tabbar-item icon="gold-coin" info="20">个人中心</van-tabbar-item>
</van-tabbar>
</div>



</template>

<script>
export default {
  data() {
    return {
      images: [
        'https://img.yzcdn.cn/1.jpg',
        'https://img.yzcdn.cn/2.jpg'
      ]
    }
  }
}
</script>

<style scoped>

</style>
