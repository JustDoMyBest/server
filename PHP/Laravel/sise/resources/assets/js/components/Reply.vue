<template>
    <div :id="'reply'+id" class="panel panel-default">
    <!-- <div :id="'reply'+data.id" class="panel panel-default"> -->
        <div class="panel-heading">
            <div class="level">
                <h5 class="flex">
                    <a :href="'/profiles/'+data.owner.name"
                        v-text="data.owner.name">
                    <!-- </a> said {{ data.created_at }}...t }} -->
                    <!-- </a> said <span v-text="ago"></span> -->
                    </a> 回复于 <span v-text="ago"></span>
                </h5>

                <!--@if(Auth::check())-->
                <!--<div>-->
                    <!--<favorite :reply="{{ $reply }}"></favorite>-->
                <!--</div>-->
                <!--@endif-->
                <!-- <div v-if="signIn"> -->
                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body" required></textarea>
                    </div>

                    <!-- <button class="btn btn-xs btn-primary" >Update</button>
                    <button class="btn btn-xs btn-link" @click="cancelReply" type="button">Cancel</button> -->
                    <button class="btn btn-xs btn-primary" >更新</button>
                    <button class="btn btn-xs btn-link" @click="cancelReply" type="button">取消</button>
                </form>
            </div>

            <!-- <div v-else v-text="body"></div> -->
            <div v-else v-html="body"></div>
            <!-- <div v-else v-text="data.body"></div> -->
        </div>

        <!--@can('update',$reply)-->
            <!-- <div class="panel-footer level" v-if="canUpdate"> -->
            <div class="panel-footer level">
                <div v-if="authorize('updateReply',reply)">
                    <!-- <button class="btn btn-xs mr-1" @click="editReply">Edit</button>
                    <button class="btn btn-xs btn-danger mr-1" @click="destroy">Delete</button> -->
                    <button class="btn btn-xs mr-1" @click="editReply">编辑</button>
                    <button class="btn btn-xs btn-danger mr-1" @click="destroy">删除</button>

                    <!-- <button class="btn btn-xs btn-default ml-a" @click="markBestReply" v-show="! isBest">Best Reply</button> -->
                </div>
            </div>
        <!--@endcan-->
    </div>
</template>
<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
              editing: false,
              id: this.data.id,
              body: this.data.body,
            //   data: this.data
              isBest: false,
              reply: this.data
            };
        },

        computed: {
            ago() {
              moment.locale('zh-cn');
              return moment(this.data.created_at).fromNow() + '...';
            },

            // signIn() {
            //     return window.App.signIn;
            // },

            // canUpdate() {
            //     // return this.data.user_id == window.App.user.id;
            //     return this.authorize(user => this.data.user_id == user.id);
            // }
        },

        methods:{
            update() {
                axios.patch('/replies/' + this.data.id,{
                        body:this.body
                    })
                    .catch(error => {
                        flash(error.response.data,'danger');
                    })
                    .then(response => {
                        if(response.status === 200){
                           this.editing = false;
 
                        //    flash('Updated!');
                           flash('更新成功！');
                        }
                    });

                // this.editing = false;

                // flash('Updated!');
            },

            destroy() {
                // axios.delete('/replies/' + this.data.id);

                this.$emit('deleted',this.data.id);

                // $(this.$el).fadeOut(300, () => {
                //     flash('Your reply has been deleted!');
                // });
            },

            editReply(){
                this.old_body_data = this.body;
                this.editing = true;
            },

            cancelReply(){
                this.body = this.old_body_data;
                this.old_body_data = '';
                this.editing = false;
            },
        }
    }
</script>