<template>
    <div>
        <!--<draggable v-model="pic_name" >-->
            <!--<transition-group>-->
        <div class="demo-upload-list " v-for="item in uploadList" :key="item.name" v-dragging="{ item: item, list: uploadList, group: 'item' }" >
            <div  style="display: none" >
                <Input type="text" name="pic[url][]"  :value="item.url_name"></Input>
            </div>
            <template v-if="item.status === 'finished'">
                <img :src="item.url" >
                <div class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline"  @click.native="handleView(item.url)"></Icon>
                    <Icon type="ios-trash-outline"  @click.native="handleRemove(item)"></Icon>
                </div>
            </template>
            <template v-else>
                <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
            </template>
           <div class="pic_name">
               <Input type="text" style="width: 100px;"  name="pic[name][]" :value="item.name"></Input>
           </div>
        </div>
            <!--</transition-group>-->
        <!--</draggable>-->
        <Upload
                ref="upload"
                :show-upload-list="false"
                :default-file-list="defaultList"
                :on-success="handleSuccess"
                :format="['jpg','jpeg','png']"
                :max-size="2048"
                :on-format-error="handleFormatError"
                :on-exceeded-size="handleMaxSize"
                :before-upload="handleBeforeUpload"
                multiple
                type="drag"
                :data="datas"
                enctype="multipart/form-data"
                :action="actionImageUrl"
                style="display: inline-block;width:100px;" >
            <div style="width:100px;height:100px;line-height: 100px;">
                <Icon type="ios-cloud-upload" size="50" style="color: #3399ff"></Icon>
            </div>
        </Upload>
        <Modal title="View Image" v-model="visible">
            <img :src="imgName" v-if="visible" style="width:100%">
        </Modal>
    </div>
</template>
<script>
//    import draggable from 'vuedraggable'
    export default {
        props: ['defaultList','actionImageUrl','imageUrl','deleteImageUrl','fileCount'],
        data () {
            return {
                pic_name:[],
                modal: false,
                imgName: '',
                visible: false,
                active: false,
                datas:{'_token':document.head.querySelector('meta[name="csrf-token"]').content},
                uploadList: [],
            }
        },
        methods: {
            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            handleRemove (file) {
                var csrf_token=document.head.querySelector('meta[name="csrf-token"]').content;
                const fileList =  this.$refs.upload.fileList;
                const Notice =  this.$Notice;
                const deleteUrl =  this.deleteImageUrl;
                swal({
                    title: '您确定要删除这个文件吗？',
                    text: '删除后将无法恢复，请谨慎操作！',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '确定删除！',
                    cancelButtonText: '取消删除'
                }).then(function (dismiss) {
                    axios.post(deleteUrl,{
                        "_token": csrf_token,
                        "_method": "delete",
                        "url":file.url_name
                    })
                        .then(function(response) {
                            swal.close();
                            Notice.success({
                                title:response.data
                            });
                            fileList.splice(fileList.indexOf(file), 1);

                        })
                        .catch(function(err) {
                            swal.close();
                            Notice.error({
                                title:err.message
                            });
                        });
                });

            },
            handleSuccess (res, file) {
                file.url = this.imageUrl+res.url;
                file.url_name =res.url;
                file.name = res.name;
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: '文件格式不正确',
                    desc: '文件格式 ' + file.name + ' 不正确，请选择jpg或png ?.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: '文件大小超过限制',
                    desc: '文件  ' + file.name + '是不是太大了，不超过2M ?'
                });
            },
            handleBeforeUpload () {
                const check = this.uploadList.length < this.fileCount;
                if (!check) {
                    this.$Notice.warning({
                        title: '最多可以上传'+this.fileCount+'张图片'
                    });
                }
                return check;
            }
        },
//        components: {
//            draggable,
//        },
        mounted () {
//            console.log("测试")
//            console.log(this.defaultList)
//            console.log(this.actionImageUrl)
//            console.log(this.imageUrl)
//            console.log(this.deleteImageUrl)
            this.uploadList = this.$refs.upload.fileList;

        }
    }
</script>

<style>
    .demo-upload-list{
        display: inline-block;
        width: 100px;
        height: 130px;
        text-align: center;
        line-height: 130px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;

    }
    .demo-upload-list img{
        width: 100px;
        height:100px
    }

    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100px;
        height: 100px;
        line-height: 100px;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
        cursor: pointer;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
    .demo-upload-list .pic_name{
        position: absolute;
        top: 45px;
        width: 100px;
        border: none;
        bottom: 0;
        left: 0;
        right: 0;
    }
    .demo-upload-list .pic_name input{
        border: none;
    }

</style>
