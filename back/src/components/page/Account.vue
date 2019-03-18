<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-cascades"></i> 账号管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tabledata" border class="table" ref="multipleTable">
                <el-table-column prop="id" label="ID" width="120"></el-table-column>
                <el-table-column prop="username" label="账号" width="150"></el-table-column>
                <el-table-column prop="authname" label="权限组"></el-table-column>
                <el-table-column prop="logintime" label="最近登录时间"></el-table-column>
                <el-table-column prop="state" label="状态" width="200">
                    <template slot-scope="scope">
                        <el-tag :type="scope.row.state == '1' ? 'success' : 'danger'" disable-transitions>{{scope.row.state | statuschange}}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="操作" width="200" align="center">
                    <template slot-scope="scope">
                        <el-button type="text" icon="el-icon-edit" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button type="text" icon="el-icon-delete" class="red" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div class="pagination">
                <el-pagination background @current-change="handleCurrentChange" layout="prev, pager, next" :total="total">
                </el-pagination>
            </div>
        </div>

        <!-- 编辑弹出框 -->
        <el-dialog title="修改账号" :visible.sync="editVisible" width="80%">
            <el-form ref="form" :model="form" label-width="50px">
                <el-form-item label="账号"><el-input v-model="form.account"></el-input></el-form-item>
                <el-form-item label="密码"><el-input v-model="form.password" type="password"></el-input></el-form-item>
                <el-form-item label="组别">
                    <el-radio-group v-model="form.role" >
                        <template v-for="a in rolelists">
                            <el-radio :label="a.id" :key="a.id">{{a.authname}}</el-radio>
                        </template> 
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="状态">
                    <el-radio-group v-model="form.state">
                        <el-radio :label="1">可用</el-radio>
                        <el-radio :label="0">禁用</el-radio>
                    </el-radio-group>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveEdit">确 定</el-button>
            </span>
        </el-dialog>
    
        <!-- 删除提示框 -->
        <el-dialog title="提示" :visible.sync="delVisible" width="300px" center>
            <div class="del-dialog-cnt">是否确定删除？</div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="delVisible = false">取 消</el-button>
                <el-button type="primary" @click="deleteRow">确 定</el-button>
            </span>
        </el-dialog>
    
    </div>
</template>

<script>
export default {
    data(){
        return {
            value: "",
            tabledata: [],
            cur_page: 1,
            total: 10,
            status: 1,
            editVisible: false,
            delVisible: false,
            del_list: [],
            multipleSelection: [],
            form: {
                id: '',
                authname: '',
                account: '',
                password: '',
                role: '',
                state: '',
            },
            rolelists: [],
        }
    },
    created() {
        this.getData();
    },
    methods: {
        handleCurrentChange(val) {
            this.cur_page = val;
            this.getData();
        },
        getData() {
            this.$axios.post('http://api.lxb.cc/index/back/getuser', {page: this.cur_page}).then((res) => {
                this.tabledata = res.data.list;
                this.total = res.data.num;
            })
        },
        handleEdit(index, row) {
            this.$axios.post('http://api.lxb.cc/index/back/role', {page: this.cur_page}).then((res) => {
                this.rolelists = res.data.list;
            })            
            this.idx = index;
            const item = this.tabledata[index];
            this.form = {
                id: item.id,
                authname: item.username,
                account: item.username,
                password: item.password,
                role: item.role,
                state: item.state
            }
            this.editVisible = true;
        },
        // 保存编辑
        saveEdit() {
            this.$axios.post('http://api.lxb.cc/index/back/saveuser', {id: this.idx + 1,form: this.form}).then((res) => {
                if(res.data){
                    this.editVisible = false;
                    this.$message.success(`修改成功`);
                    this.getData();
                }else {
                    this.$message.error(`修改失败`);
                }
            })
        },
        handleDelete(index, row) {
            this.idx = index;
            this.delVisible = true;
        },
        deleteRow(){
            this.$axios.post('http://api.lxb.cc/index/back/deleteuser', {id: this.idx + 1}).then((res) => {
                if(res.data){
                    this.tabledata.splice(this.idx, 1);
                    this.$message.success('删除成功');
                    this.delVisible = false;
                }else {
                    this.$message.error(`删除失败`);
                }
            })
        },
    },
    filters: {
        statuschange: function(value) {
            if(value == 1){return '可用';}
            else {return '禁用';}
        },
    }
}
</script>
<style scoped>
    .handle-box {
        margin-bottom: 20px;
    }

    .handle-select {
        width: 120px;
    }

    .handle-input {
        width: 300px;
        display: inline-block;
    }
    .del-dialog-cnt{
        font-size: 16px;
        text-align: center
    }
    .table{
        width: 100%;
        font-size: 14px;
    }
    .red{
        color: #ff0000;
    }
    .mr10{
        margin-right: 10px;
    }
</style>

