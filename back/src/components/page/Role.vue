<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-cascades"></i> 权限组</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tabledata" border class="table" ref="multipleTable">
                <el-table-column prop="id" label="ID" width="120"></el-table-column>
                <el-table-column prop="authname" label="权限组" width="150"></el-table-column>
                <el-table-column prop="rolelist" label="启用功能"></el-table-column>
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
        <el-dialog title="修改权限" :visible.sync="editVisible" width="80%">
            <el-form ref="form" :model="form" label-width="50px">
                <el-form-item label="名称"><el-input v-model="form.authname"></el-input></el-form-item>
                <el-form-item label="列表">
                    <template v-for="a in rolelists">
                        <p v-if="a.isroot == 1">{{a.rolename}}</p>
                            <el-checkbox-group v-model="form.rolelist"  @change="handleCheckedCitiesChange">
                                <el-checkbox v-if="a.belong == 2" :label="a.rolename" :key="a.rolename">{{a.rolename}}</el-checkbox>
                                <el-checkbox v-else :label="a.rolename" :key="a.rolename">{{a.rolename}}</el-checkbox>
                            </el-checkbox-group>
                    </template> 
                </el-form-item>
                <el-form-item label="状态">
                    <el-radio-group v-model="form.state">
                        <el-radio :label="1">发布</el-radio>
                        <el-radio :label="0">草稿</el-radio>
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
            adminrole:[],
            cur_page: 1,
            total: 10,
            status: 1,
            searchbox:[{
                value: "",
                input: "",
            }],
            editVisible: false,
            delVisible: false,
            del_list: [],
            multipleSelection: [],
            form: {
                id: '',
                authname: '',
                rolelist: [],
                state: '',
            },
            options:[{value: 1,label: 'vue'},{value: 2,label: 'jquery'},{value: 3,label: 'nodejs'},{value: 4,label: 'tp3'},{value: 5,label: 'tp5'},{value: 6,label: 'linux'},
            {value: 7,label: 'xshell'},{value: 8,label: 'docker'},{value: 9,label: 'ES6'},{value: 10,label: '正则'},{value: 12,label: 'git'}],
            checkAll: false,
            isIndeterminate: true,
            rolelists:[],
        }
    },
    created() {
        this.getData();
    },
    methods: {
        search() {
            this.$axios.post('http://api.lxb.cc/index/back/ms', {value: this.searchbox.value,input: this.searchbox.input}).then((res) => {
                this.tabledata = res.data.list;
                this.total = res.data.num;
            })
        },
        handleCurrentChange(val) {
            this.cur_page = val;
            this.getData();
        },
        getData() {
            this.$axios.post('http://api.lxb.cc/index/back/role', {page: this.cur_page}).then((res) => {
                this.tabledata = res.data.list;
                this.total = res.data.num;
                this.adminrole = res.data.list;
            })
        },
        handleEdit(index, row) {
            //展示所有的权限组，根据index的数据勾选
            this.$axios.post('http://api.lxb.cc/index/back/rolelist').then((res)=>{
                this.rolelists = res.data.list;//返回所有权限名字
                this.adminrole = res.data.role;
            })
            this.idx = index;
            const item = this.adminrole[index];
            this.getData();
            this.form = {
                id: item.id,
                authname: item.authname,
                rolelist: JSON.parse(item.rolelist),
                state: item.state
            }
            this.editVisible = true;
        },
        // 保存编辑
        saveEdit() {
            this.$axios.post('http://api.lxb.cc/index/back/save', {id: this.idx + 1,form: this.form}).then((res) => {
                if(res.data){
                    this.editVisible = false;
                    this.$message.success(`修改成功`);
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
            this.$axios.post('http://api.lxb.cc/index/back/delete', {id: this.idx + 1}).then((res) => {
                if(res.data){
                    this.tabledata.splice(this.idx, 1);
                    this.$message.success('删除成功');
                    this.delVisible = false;
                }else {
                    this.$message.error(`删除失败`);
                }
            })
        },
        handleCheckedCitiesChange(value) {
            console.log(value);
            // let checkedCount = value.length;
            // this.checkAll = checkedCount === this.cities.length;
            // this.isIndeterminate = checkedCount > 0 && checkedCount < this.cities.length;
        }
    },
    filters: {
        statuschange: function(value) {
            if(value == 1){return '可用';}
            else {return '禁用';}
        },
        typechange: function (value) {
            switch(value) {
                //1:vue 2:jquery 3:nodejs 4:tp3 5:tp5 6:linux 7:xshell 8:docker 9:ES6 10:正则 11:webpack 12Git
                case 1 : return 'vue';
                case 2 : return 'jquery';
                case 3 : return 'nodejs';
                case 4 : return 'tp3';
                case 5 : return 'tp5';
                case 6 : return 'linux';
                case 7 : return 'xshell';
                case 8 : return 'docker';
                case 9 : return 'ES6';
                case 10 : return '正则';
                case 11 : return 'webpack';
                case 12 : return 'Git';
                default : return 'false';
            }
        }
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

