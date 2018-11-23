<template>
  <div class="app-container">
    <el-input v-model="filterText" placeholder="搜索权限功能" style="margin-bottom:30px;" />

    <el-tree
      ref="tree2"
      :data="data2"
      :props="defaultProps"
      :filter-node-method="filterNode"
      class="filter-tree"
      default-expand-all
    />

  </div>
</template>

<script>
export default {

  data() {
    return {
      filterText: '',
      data2: [{
        id: 1,
        label: '文章管理',
        children: [{
          id: 2,
          label: '文章管理',
        }]
      }, {
        id: 3,
        label: '权限管理',
        children: [{
          id: 4,
          label: '权限树'
        }, {
          id: 5,
          label: '权限组'
        }, {
          id: 6,
          label: '权限角色'
        }]
      }, {
        id: 7,
        label: '账号管理',
        children: [{
          id: 8,
          label: '账号管理'
        }]
      }, {
        id: 9,
        label: '底部链接',
        children: [{
          id: 10,
          label: '底部链接'
        }]
      }],
      defaultProps: {
        children: 'children',
        label: 'label'
      }
    }
  },
  watch: {
    filterText(val) {
      this.$refs.tree2.filter(val)
    }
  },

  methods: {
    filterNode(value, data) {
      if (!value) return true
      return data.label.indexOf(value) !== -1
    }
  }
}
</script>

