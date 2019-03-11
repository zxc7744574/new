<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-cascades"></i> 基础表格</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="handle-box">
                <el-button type="primary" icon="delete" class="handle-del mr10" @click="delAll">批量删除</el-button>
                <el-select v-model="searchbox.value" placeholder="筛选标签" class="handle-select mr10">
                    <el-option key="1" label="vue" value="1"></el-option>
                    <el-option key="2" label="jquery" value="2"></el-option>
                    <el-option key="3" label="nodejs" value="3"></el-option>
                    <el-option key="4" label="tp3" value="4"></el-option>
                    <el-option key="5" label="tp5" value="5"></el-option>
                    <el-option key="6" label="linux" value="6"></el-option>
                    <el-option key="7" label="xshell" value="7"></el-option>
                    <el-option key="8" label="docker" value="8"></el-option>
                    <el-option key="9" label="ES6" value="9"></el-option>
                    <el-option key="10" label="正则" value="10"></el-option>
                    <el-option key="11" label="webpack" value="11"></el-option>
                    <el-option key="12" label="Git" value="12"></el-option>
                </el-select>
                <el-input v-model="searchbox.input" placeholder="筛选标题关键词" class="handle-input mr10"></el-input>
                <el-button type="primary" icon="search" @click="search">搜索</el-button>
            </div>
            <el-table :data="tabledata" border class="table" ref="multipleTable" @selection-change="handleSelectionChange">
                <el-table-column type="selection" width="55" align="center"></el-table-column>
                <el-table-column prop="id" label="ID" sortable width="150"></el-table-column>
                <el-table-column prop="name" label="标题"></el-table-column>
                <el-table-column prop="title" label="作者" width="120"></el-table-column>
                <el-table-column prop="create_time" label="创建时间" width="200"></el-table-column>
                <el-table-column prop="status" label="状态" width="120" >
                    <template slot-scope="scope">
                        <el-tag :type="scope.row.status == '1' ? 'success' : 'danger'" disable-transitions>{{scope.row.status | statuschange}}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column prop="type" label="标签" width="120">
                    <template slot-scope="scope">
                        <el-tag disable-transitions>{{scope.row.type | typechange}}</el-tag>
                    </template>  
                </el-table-column>
                <el-table-column label="操作" width="180" align="center">
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
        <el-dialog title="修改文章" :visible.sync="editVisible" width="80%">
            <el-form ref="form" :model="form" label-width="50px">
                <el-form-item label="标题"><el-input v-model="form.name"></el-input></el-form-item>
                <el-form-item label="作者"><el-input v-model="form.title"></el-input></el-form-item>
                <el-form-item label="内容"><el-input v-model="form.content" type="textarea" :rows="5"></el-input></el-form-item>
                <el-form-item label="状态">
                    <el-radio-group v-model="form.status">
                        <el-radio :label="1">发布</el-radio>
                        <el-radio :label="0">草稿</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="标签">
                    <el-select v-model="form.type" placeholder="请选择">
                        <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                        </el-option>
                    </el-select>
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
            searchbox:[{
                value: "",
                input: "",
            }],
            editVisible: false,
            delVisible: false,
            del_list: [],
            multipleSelection: [],
            form: {
                name: '',
                title: '',
                content: '',
                status: '',
                type: '',
            },
            options:[{value: 1,label: 'vue'},{value: 2,label: 'jquery'},{value: 3,label: 'nodejs'},{value: 4,label: 'tp3'},{value: 5,label: 'tp5'},{value: 6,label: 'linux'},
            {value: 7,label: 'xshell'},{value: 8,label: 'docker'},{value: 9,label: 'ES6'},{value: 10,label: '正则'},{value: 12,label: 'git'}]
        }
    },
    created() {
        this.getData();
    },
    methods: {
        delAll() {
            console.log('delete all');
        },
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
            this.$axios.post('http://api.lxb.cc/index/back/ms', {page: this.cur_page}).then((res) => {
                this.tabledata = res.data.list;
                this.total = res.data.num;
            })
        },
        handleEdit(index, row) {
            this.idx = index;
            const item = this.tabledata[index];
            this.form = {
                name: item.name,
                title: item.title,
                content: item.content,
                status: item.status,
                type: item.type
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
        delAll() {
            this.$axios.post('http://api.lxb.cc/index/back/delall', {list: this.multipleSelection}).then((res) => {
                if(res.data == 1){
                    const length = this.multipleSelection.length;
                    let str = '';
                    this.del_list = this.del_list.concat(this.multipleSelection);
                    for (let i = 0; i < length; i++) {
                        str += this.multipleSelection[i].name + ' ';
                    }
                    this.$message.error('删除了' + str);
                    this.multipleSelection = [];
                    this.getData();
                }else {
                    this.$message.error(`批量删除失败`);
                }
            })

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
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
    },
    filters: {
        statuschange: function(value) {
            if(value == 1){return '发布';}
            else {return '草稿';}
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

