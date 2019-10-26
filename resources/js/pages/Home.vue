<template>
    <div class="home" :style="home_style">
        <el-popover
                ref="popover1"
                placement="top-start"
                title="hello～"
                width="200"
                trigger="hover"
                content="点击图片进入我的家～">
        </el-popover>
        <transition name="el-fade-in-linear">
            <div v-show="loading_screen" @click="cancelLoadingImage" class="loading-screen" v-loading="loadings.bg_loading" :style="{'background-image':bg_url}">
                <el-avatar v-if="other.avatar !== null" class="loading-avatar" :size="55" :src="other.avatar"></el-avatar><el-avatar class="loading-avatar" :size="55"  v-if="other.avatar===null">{{other.name}}</el-avatar>
                <div class="loading-introduction"><span class="rotate">{{other.name}}</span><span v-if="other.introduction">{{'--'+other.introduction}}</span></div>
            </div>
        </transition>
        <el-row class="main" type="flex" justify="center" :style="main_style" v-show="!loading_image">
            <el-col :xs="24" :sm="24" :md="16" :lg="16">
            <div class="container" >
        <div id="content" class="row" >
            <el-col :sm="8">
                <!--namecard-->
                <div id="namecard" class="namecard">
                    <div class="shadow-img" v-loading="loadings.bg_namecard_loading" :style="{'background-image':getImage(0)}"></div>
                    <h1 class="maintitle">{{other.name}}<span class="invert"></span></h1><!--PROFILE NAME-->
                    <h3 class="invert sub-maintitle">
                        <transition name="el-fade-in-linear">
                            <template>
                                <span v-show="userTags.show" class="rotate">{{userTags.tag}}</span><!--SUBTITLE AFTET NAME-->
                            </template>
                        </transition>
                    </h3>
                    <img id="profile-img" class="profile-img transparent" :src="other.avatar" alt="加载失败"><!--PROFILE IMAGE-->
                </div><!--/#namecard-->
                <!--menu-->
                <div id="menu-container">
                    <!--PAGE MENU-->
                    <ul class="nav-menu no-padding">
                        <li :class="selector.home" title="Home" data-page="home" @click="showHomePage">
                            <div class="hover-background"></div>
                            <span>个人主页</span><i class="fa fa-user fa-fw"></i>
                        </li>
                        <li :class="selector.resume" id="resume-btn" title="Resume"  data-page="resume" @click="showResumePage">
                            <div class="hover-background"></div>
                            <span>我的简历</span><i class="fa fa-file-text fa-fw"></i>
                        </li>
                        <li :class="selector.edit" v-if="policyConfirm" id="edit-btn" title="Edit"  data-page="edit" @click="showEditPage"  key="2">
                            <div class="hover-background"></div>
                            <span>更新信息</span><i class="fa fa-file-text fa-fw"></i>
                        </li>
                    </ul><!--/.nav-menu __PAGE MENU ENDS-->
                </div><!--#menu-container-->
            </el-col>
            <transition name="el-zoom-in-center">
            <el-col class="page-segment" :sm="16" v-show="page.show">
                <ul class="page-container no-padding">
                    <!--HOME/PROFILE PAGE-->
                    <li id="home" v-show="page.home_page">
                        <div class="title-container">
                            <div class="shadow-img" v-loading="loadings.bg_home_loading" :style="{'background-image':getImage(1)}"></div>
                            <h2 :class="selector.home">Welcome To <span class="invert">My Profile</span></h2><!--HOME TITLE-->
                        </div>
                        <div class="description">
                            <div class="watermark-home"></div>

                            <div class="fade-text transparent">
                                <!--DESCRIPTION ON HOME-->
                                <div class="strong-text">你好，我是 <span>{{other.name}}</span></div>
                                <div class="focus-text"><span>Web Developer & </span><span>Web Designer</span></div>
                                <p class="large-paragraph">I have 3 years experience as a web/interface designer.I have a love of clean, elegant coding. I have lots of experience in the production of PHP and HTML for modern websites.</p>
                                <!--DESCRIPTION ON HOME ENDS-->
                            </div>

                            <!--ALL PERSONAL DETAILS-->
                            <h3 class="personal-info-title title">个人信息</h3>
                            <ul class="personal-info">
                                <li :class="page.name_class_1"><label>昵称</label><span>{{other.name}}</span></li>
                                <li :class="page.name_class_2"><label>博客</label><span>{{blog_page+other.id}}</span></li>
                                <li :class="page.name_class_3"><label>Email</label><span>{{other.email !== null ? other.email : '保密'}}</span></li>
                                <li :class="page.name_class_4"><label>电话</label><span>{{'保密'}}</span></li>
                            </ul><!--/ul.personal-info-->
                        </div>
                    </li><!--/#home-->
                    <!--RESUME PAGE-->
                    <li id="resume" v-show="page.resume_page">
                        <div class="title-container">
                            <div class="shadow-img" v-loading="loadings.bg_resume_loading" :style="{'background-image':getImage(2)}"></div>
                            <h2 :class="selector.resume"><span class="invert">Resume Of</span> {{other.name}}</h2> <!--RESUME TITLE-->
                        </div>
                        <div class="description">

                            <div class='tabs tabs_animate'>
                                <!--RESUME TAB LISTS-->
                                <el-tabs v-model="activeName">
                                    <el-tab-pane label="技能" name="first"><!--RESUME FIRST TAB/SKILL TAB DETAILS-->
                                        <div id='tab-1'>
                                            <ul class="skills-list no-padding">
                                                <li class="row">
                                                    <el-col :xs="24"><div class="fw-mid">HTML</div></el-col>
                                                    <el-col :xs="24">
                                                        <div class="bar">
                                                            <el-progress :text-inside="true" :stroke-width="26" :percentage="100"></el-progress>
                                                        </div>
                                                    </el-col>
                                                    <div class="lv-clear-both"></div>
                                                </li>
                                                <li class="row">
                                                    <el-col :xs="24"><div class="fw-mid">CSS</div></el-col>
                                                    <el-col :xs="24">
                                                        <div class="bar">
                                                            <el-progress :text-inside="true" :stroke-width="24" :percentage="90" status="success"></el-progress>
                                                        </div>
                                                    </el-col>
                                                    <div class="lv-clear-both"></div>
                                                </li>
                                                <li class="row">
                                                    <el-col :xs="24"><div class="fw-mid">JavaScript</div></el-col>
                                                    <el-col :xs="24">
                                                        <div class="bar">
                                                            <el-progress :text-inside="true" :stroke-width="22" :percentage="80" status="warning"></el-progress>
                                                        </div>
                                                    </el-col>
                                                    <div class="lv-clear-both"></div>
                                                </li>
                                            </ul><!--SKILLS WITH BAR DISPLAY ENDS-->
                                            <div class="lv-clear-both"></div>
                                            <!--SKILLS WITH CIRCLE DISPLAY-->
                                            <div class="circle-skill-container">
                                                <h3 class="title">其他技能</h3>
                                                <div class="row">
                                                    <el-col class="center-align" :lg="8" :md="8" :sm="12" :xs="12">
                                                        <el-progress type="circle" :percentage="80"></el-progress>
                                                        <h5>PHP</h5>
                                                    </el-col>
                                                    <el-col class="center-align" :lg="8" :md="8" :sm="12" :xs="12">
                                                        <el-progress type="circle" :percentage="60"></el-progress>
                                                        <h5>Linux</h5>
                                                    </el-col>
                                                    <el-col class="center-align" ::lg="8" :md="8" :sm="12" :xs="12">
                                                        <el-progress type="circle" :percentage="25"></el-progress>
                                                        <h5>Python</h5>
                                                    </el-col>
                                                </div>
                                            </div><!--SKILLS WITH CIRCLE DISPLAY ENDS-->
                                        </div><!--RESUME FIRST TAB/SKILL TAB DETAILS ENDS--></el-tab-pane>
                                    <el-tab-pane label="学历" name="second">
                                        <!--RESUME SECOND TAB/EDUCATION TAB DETAILS-->
                                        <div id='tab-2'>
                                                    <!--EDUCATION LIST ITEM-->
                                            <el-collapse accordion  v-model="activeNameC">
                                                <el-collapse-item name="1">
                                                    <template slot="title" >
                                                        Consectetur adipiscing <span class="list-year">(2019 - 2020)</span><i class="header-icon el-icon-info"></i>
                                                    </template>
                                                    <div class="list-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit Vivamus sit. Vivamus sit.. consectetur adipiscing Vivamus sit. Vivamus sit</p><!--EDUCATION LIST DETAILS-->
                                                    </div>
                                                </el-collapse-item>
                                                <el-collapse-item name="2">
                                                    <template slot="title" >
                                                        Consectetur adipiscing <span class="list-year">(2018 - 2019)</span><i class="header-icon el-icon-info"></i>
                                                    </template>
                                                    <div class="list-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit Vivamus sit. Vivamus sit.. consectetur adipiscing Vivamus sit. Vivamus sit</p><!--EDUCATION LIST DETAILS-->
                                                    </div>
                                                </el-collapse-item>
                                                <el-collapse-item name="3">
                                                    <template slot="title" >
                                                        Consectetur adipiscing <span class="list-year">(2017 - 2018)</span><i class="header-icon el-icon-info"></i>
                                                    </template>
                                                    <div class="list-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit Vivamus sit. Vivamus sit.. consectetur adipiscing Vivamus sit. Vivamus sit</p><!--EDUCATION LIST DETAILS-->
                                                    </div>
                                                </el-collapse-item>
                                            </el-collapse>
                                        </div><!--RESUME SECOND TAB/EDUCATION TAB DETAILS ENDS-->
                                    </el-tab-pane>
                                    <!--<el-tab-pane label="职业" name="third">-->
                                        <!--&lt;!&ndash;RESUME THIRD TAB/EMPLYMENT TAB DETAILS ENDS&ndash;&gt;-->
                                        <!--<div id='tab-3'>-->
                                            <!--<ul class="employment-class tab-cont">-->
                                                <!--<li>-->
                                                    <!--&lt;!&ndash;EMPLOYMENT INDIVIDUAL LIST&ndash;&gt;-->
                                                    <!--<h4>Manager <span class="year">2019 - 2020</span></h4>-->
                                                    <!--<h5>Consectetur adipiscing</h5>-->
                                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit Vivamus sit. Vivamus sit.. consectetur adipiscing Vivamus sit.</p>&lt;!&ndash;EMPLOYMENT LIST DETAILS&ndash;&gt;-->
                                                <!--</li>-->
                                                <!--<li>-->
                                                    <!--&lt;!&ndash;EMPLOYMENT INDIVIDUAL LIST&ndash;&gt;-->
                                                    <!--<h4>Manager <span class="year">2018 - 2019</span></h4>-->
                                                    <!--<h5>Consectetur adipiscing</h5>-->
                                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit Vivamus sit. Vivamus sit.. consectetur adipiscing Vivamus sit.</p>&lt;!&ndash;EMPLOYMENT LIST DETAILS&ndash;&gt;-->
                                                <!--</li>-->
                                                <!--<li>-->
                                                    <!--&lt;!&ndash;EMPLOYMENT INDIVIDUAL LIST&ndash;&gt;-->
                                                    <!--<h4>Manager <span class="year">2017 - 2018</span></h4>-->
                                                    <!--<h5>Consectetur adipiscing</h5>-->
                                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit Vivamus sit. Vivamus sit.. consectetur adipiscing Vivamus sit.</p>&lt;!&ndash;EMPLOYMENT LIST DETAILS&ndash;&gt;-->
                                                <!--</li>-->
                                            <!--</ul>-->
                                        <!--</div>&lt;!&ndash;RESUME THIRD TAB/EMPLYMENT TAB DETAILS ENDS&ndash;&gt;-->
                                    <!--</el-tab-pane>-->
                                    <el-tab-pane label="归档" name="forth">
                                        <!--RESUME THIRD TAB/EMPLYMENT TAB DETAILS ENDS-->
                                        <div id='tab-4'>
                                            <Archieve></Archieve>
                                        </div><!--RESUME THIRD TAB/EMPLYMENT TAB DETAILS ENDS-->
                                    </el-tab-pane>
                                </el-tabs>
                            </div>
                        </div>
                    </li>
                    <!--/#resume-->
                    <!--RESUME PAGE-->
                    <li id="edit" v-if="page.edit_page && policyConfirm"  key="1">
                        <div class="title-container">
                            <div class="shadow-img" v-loading="loadings.bg_edit_loading" :style="{'background-image':getImage(3)}"></div>
                            <h2 :class="selector.resume"><span class="invert">Editor Of</span> {{other.name}}</h2> <!--RESUME TITLE-->
                        </div>
                        <div class="description">
                            <div class='tabs tabs_animate'>
                                <!--RESUME TAB LISTS-->
                                <el-tabs v-model="activeNameEditor">
                                    <el-tab-pane label="资料管理" name="firstEditor"><!--RESUME FIRST TAB/SKILL TAB DETAILS-->
                                        <div id='tab-edit-1'>
                                            <effect-input class="effect-input" v-model="editor.name" type="ichiro" label="修改昵称" name="昵称"></effect-input>
                                            <effect-input class="effect-input" v-model="editor.email" type="ichiro" label="修改邮箱" name="邮箱"></effect-input>
                                            <effect-input class="effect-input" v-model="editor.introduction" type="juro" label="修改简介" name="简介"></effect-input>
                                            <el-upload
                                                    :limit=1
                                                    class="avatar-uploader"
                                                    :http-request="uploadAvatar"
                                                    :show-file-list="false"
                                                    action="customize">
                                                <img v-if="editor.avatar" :src="editor.avatar" class="avatar">
                                                <i class="el-icon-upload"></i>
                                                <div class="el-upload__text">将文件拖到此处,或<em>点击上传</em></div>
                                            </el-upload>
                                        </div><!--RESUME FIRST TAB/SKILL TAB DETAILS ENDS-->
                                        <el-button class="edit-profile-button" type="primary" @click="updateUserProfile">更新资料</el-button>
                                    </el-tab-pane>
                                    <el-tab-pane label="技能管理" name="secondEditor">
                                        <!--RESUME SECOND TAB/EDUCATION TAB DETAILS-->
                                        <div id='tab-edit-2'>
                                            <h3 class="title">开发中...</h3>
                                            <el-image
                                                    style="width: 100%; height: 100%"
                                                    src="https://mozilan.geekadpt.cn/img/other/image-404.png"
                                                    fit='contain'></el-image>
                                            <!--EDUCATION LIST ITEM-->
                                        </div><!--RESUME SECOND TAB/EDUCATION TAB DETAILS ENDS-->
                                    </el-tab-pane>
                                    <el-tab-pane label="评论管理" name="thirdEditor">
                                        <!--RESUME THIRD TAB/EMPLYMENT TAB DETAILS ENDS-->
                                        <div id='tab-edit-3'>
                                            <h3 class="title">开发中...</h3>
                                            <el-image
                                                    style="width: 100%; height: 100%"
                                                    src="https://mozilan.geekadpt.cn/img/other/image-404.png"
                                                    fit='contain'></el-image>
                                        </div><!--RESUME THIRD TAB/EMPLYMENT TAB DETAILS ENDS-->
                                    </el-tab-pane>
                                </el-tabs>
                            </div>
                        </div>
                    </li>
                    <!--/#resume-->
                </ul>
            </el-col><!--/.page-segment -->
            </transition>
            <!--  <h6 class="copyright-text">Copyright © 2015 {{other.name}}</h6> --> <!--if anyone wants copyright Texts-->
        </div>
    </div><!--/.container -->
            </el-col>
        </el-row>
    </div>
</template>
<script>
    import {EffectInput} from 'effect-input'
    import 'effect-input/dist/index.css';
    import { LVBLOG_CONFIG } from '../config';
    import Archieve from '../components/Home/Archive'
    var a = new Array(100);
    export default {
        name: "Home",
        components:{
            EffectInput:EffectInput,
            Archieve,
        },
        data() {
            return {
                home_style:{
                  minHeight:'',
                },
                main_style:{
                    height:'',
                },
                activeName:'first',
                activeNameEditor:'firstEditor',
                activeNameC:'1',
                loading_screen:true,
                loading_image:true,
                page:{
                    show:false,
                    home_page:false,
                    resume_page:false,
                    edit_page:false,
                    name_class_1:'rotate-out rotated',
                    name_class_2:'rotate-out rotated',
                    name_class_3:'rotate-out rotated',
                    name_class_4:'rotate-out rotated',
                },
                selector:{
                    home:"nav-btn selected",
                    resume: "nav-btn",
                    edit: "nav-btn"
                },
                userTags: {
                    tag: '',
                    tags: ['Web Developer', 'Web Designer', 'Web Artist'],
                    show:true
                },
                bg_frontpage:'https://mozilan.geekadpt.cn/img/custom/cover/front-image.jpg',
                bg_frontpage_url :'',
                bg_url:'',
                img_src: this.$store.getters.getConfigs.IMG_API,
                img_num:['1','2','3','4'],
                loadings:{
                    bg_loading:true,
                    bg_front_loading:true,
                    bg_namecard_loading:true,
                    bg_home_loading:true,
                    bg_resume_loading:true,
                    bg_edit_loading:true,
                },
                editor:{
                    name:'',
                    email:'',
                    avatar:'',
                    avatar_image_id:'',
                    introduction:'',
                    skills:{},
                    other_skills:{},
                },
                original_user:{
                    name:'{{other.name}}',
                    avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
                    introduction:'向上的路并不拥挤，而有的人选择了安逸',
                    email:'{{other.name}}@aliyun.com',
                    avatar_image_id:'',
                    blog_page:''
                },
            }
        },
        mounted(){
            setTimeout(()=>{
                if(this.loading_screen){
                    this.cancelLoadingImage();
                }
            },5000);
            this.changeUserTag();
            //背景图片加载loading;
            let bgImg = new Image();
            bgImg.src = this.$store.getters.getConfigs.IMG_API; // 获取背景图片的url
            bgImg.onerror = () => {
                console.log('bg_img onerror')
            };
            bgImg.onload = () => { // 等背景图片加载成功后 去除loadingavatar_image_id
                this.loadings.bg_loading = false
            };
            //引导页背景图片加载loading;
            let bgFrontImg = new Image();
            bgFrontImg.src = this.bg_frontpage; // 获取背景图片的url
            bgFrontImg.onerror = () => {
                console.log('bgImg_Front onerror')
            };
            bgFrontImg.onload = () => { // 等背景图片加载成功后 去除loadingavatar_image_id
                this.loadings.bg_front_loading = false
            };
            //namecard加载loading;
            let bgImg_namecard = new Image();
            bgImg_namecard.src = this.$store.getters.getConfigs.IMG_API+a[0]; // 获取背景图片的url
            // console.log("namecard 背景图片地址"+bgImg_namecard.src);
            bgImg_namecard.onerror = () => {
                console.log('bgImg_namecard load error')
            };
            bgImg_namecard.onload = () => { // 等背景图片加载成功后 去除loading
                this.loadings.bg_namecard_loading= false
            };
            //home加载loading
            let bgImg_home = new Image();
            bgImg_home.src = this.$store.getters.getConfigs.IMG_API+a[1]; // 获取背景图片的url
            bgImg_home.onerror = () => {
                console.log('bgImg_home load error')
            };
            bgImg_home.onload = () => { // 等背景图片加载成功后 去除loading
                this.loadings.bg_home_loading = false
            };
            //resume加载loading
            let bgImg_resume = new Image();
            bgImg_resume.src = this.$store.getters.getConfigs.IMG_API+a[2]; // 获取背景图片的url
            bgImg_resume.onerror = () => {
                console.log('bgImg_resume load rror')
            };
            bgImg_resume.onload = () => { // 等背景图片加载成功后 去除loading
                this.loadings.bg_resume_loading = false
            };
            //edit加载loading
            let bgImg_edit = new Image();
            bgImg_edit.src = this.$store.getters.getConfigs.IMG_API+a[3]; // 获取背景图片的url
            bgImg_edit.onerror = () => {
                console.log('bgImg_edit load error')
            };
            bgImg_edit.onload = () => { // 等背景图片加载成功后 去除loading
                this.loadings.bg_edit_loading = false
            }
        },
        methods:{
            cancelLoadingImage(){
                this.loading_screen = false;
                this.loading_image = false;
                this.showHomePage();
            },
            showHomePage(){
                if(window.innerWidth < 683){
                    this.home_style={
                        minHeight:'1500px',
                    };
                }
                this.page.show = false;
                this.page.resume_page=false;
                this.page.edit_page=false;
                this.page.home_page=true;
                this.selector.resume='';
                this.selector.edit='';
                this.selector.home = 'nav-btn selected';
                setTimeout(()=>{
                    this.page.show=true;
                },1000);
                setTimeout(()=>{
                    this.page.name_class_1='rotate-out';
                },2000);
                setTimeout(()=>{
                    this.page.name_class_2='rotate-out';
                },2500);
                setTimeout(()=>{
                    this.page.name_class_3='rotate-out';
                },3000);
                setTimeout(()=>{
                    this.page.name_class_4='rotate-out';
                },3500);
            },
            showResumePage(){
                if(window.innerWidth < 683){
                    this.home_style={
                        minHeight:'1500px',
                    };
                }
                this.page.show = false;
                this.page.home_page=false;
                this.page.edit_page=false;
                this.page.resume_page=true;
                this.selector.home='';
                this.selector.edit='';
                this.selector.resume='nav-btn selected';
                this.page.name_class_1='rotate-out rotated ';
                this.page.name_class_2='rotate-out rotated ';
                this.page.name_class_3='rotate-out rotated ';
                this.page.name_class_4='rotate-out rotated ';
                setTimeout(()=>{
                    this.page.show=true;
                },1000);
            },
            showEditPage(){
                if(window.innerWidth < 683){
                    this.home_style={
                        minHeight:'1500px',
                    };
                }
                this.page.show = false;
                this.page.home_page=false;
                this.page.resume_page=false;
                this.page.edit_page=true;
                this.selector.home='';
                this.selector.resume='';
                this.selector.edit='nav-btn selected';
                this.page.name_class_1='rotate-out rotated ';
                this.page.name_class_2='rotate-out rotated ';
                this.page.name_class_3='rotate-out rotated ';
                this.page.name_class_4='rotate-out rotated ';
                setTimeout(()=>{
                    this.page.show=true;
                },1000);
            },
            changeUserTag(){
                var i = -1 ;
                this.userTags.tag=this.userTags.tags[0];
                setInterval(()=>{
                    this.userTags.show=false;
                    ++i;
                    if(i>=this.userTags.tags.length){
                        i=0;
                    }
                    this.userTags.tag=this.userTags.tags[i];
                    setTimeout(()=>{
                        this.userTags.show=true;
                    },1000);
                },6000);
            },
            getRandomNum(range){
                // console.log(Math.floor(Math.random()*range));
                return Math.floor(Math.random()*range);
            },
            getImage(num) {
                // console.log(a[num]);
                let uid = this.$route.params.user ? this.$route.params.user : 1;
                if(a[num] === undefined) {
                    a[num] = this.getRandomNum(1000);
                }
                return "url(" + this.$store.getters.getConfigs.IMG_API + a[num] + ")";
            },
            uploadAvatar(params) {
                const isJPG = params.file.type === 'image/jpeg';
                const isLt2M = params.file.size / 1024 / 1024 < 2;
                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                    return false;
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                    return false;
                }
                // 通过 FormData 对象上传文件
                var formData = new FormData();
                formData.append("image", params.file);
                formData.append('type', 'avatar');
                this.$store.dispatch('upLoadImages', formData);
                this.$watch(this.$store.getters.getImagesUpLoadStatus, function () {
                    if (this.$store.getters.getImagesUpLoadStatus() === 2) {
                        this.editor.avatar = this.$store.getters.getImages.data.path;
                        this.editor.avatar_image_id = this.$store.getters.getImages.data.id;
                    } else if (this.$store.getters.getImagesUpLoadStatus() === 3) {
                        this.$message.error('上传头像失败了,可能是登陆超时造成的!');
                    }
                });
            },
            updateUserProfile(){
                let original_user_profile =  this.$store.getters.getUser;
                this.loader = this.$loading({
                    lock: true,
                    text: '提交中...',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
                this.$store.dispatch('updateUserProfile',{
                    name:this.editor.name ===''? original_user_profile.name:this.editor.name,
                    avatar:this.editor.avatar===''?original_user_profile.avatar:this.editor.avatar,
                    avatar_image_id:this.editor.avatar_image_id===''?original_user_profile.avatar_image_id:this.editor.avatar_image_id,
                    introduction:this.editor.introduction===''?original_user_profile.introduction:this.editor.introduction,
                    email:this.editor.email===''?original_user_profile.email:this.editor.email,
                });
                this.$watch(this.$store.getters.getUserProfileUpdateStatus, function () {
                    if (this.$store.getters.getUserProfileUpdateStatus()  === 2) {
                        this.loader.close();
                        this.$message.success('更新成功');
                        this.editor.name = '';
                        this.editor.avatar = '';
                        this.editor.introduction = '';
                        this.editor.email = '';
                        this.$store.dispatch('loadOther',{
                            other : this.$route.params.user
                        });
                        this.showHomePage();
                    }
                    if (this.$store.getters.getUserProfileUpdateStatus()  === 3) {
                        this.loader.close();
                        this.$message.error(this.$store.getters.getUserProfileUpdateMessages());
                    }
                });
            },
        },
        created(){
            a = [];
            if(window.innerWidth > 763){
                // console.log("高"+window.innerHeight);
                // this.home_style.minHeight = window.innerHeight + "px";
                this.main_style.height = window.innerHeight - 145 + "px";
            }
            this.getImage(0);
            this.getImage(1);
            this.getImage(2);
            this.getImage(3);
            this.$store.dispatch('loadOther',{
               other : this.$route.params.user
            });
            this.bg_frontpage_url ="url(" + this.bg_frontpage + ")";
            let uid = this.$route.params.user ? this.$route.params.user:1;
            this.bg_url ="url(" + this.$store.getters.getConfigs.IMG_API + uid + ")";
            this.blog_page = LVBLOG_CONFIG.URL+ '/blog/user/';
        },
        computed:{
            user(){
                return this.$store.getters.getUser;
            },
            other(){
                return this.$store.getters.getOther;
            },
            policyConfirm(){
                return parseInt(this.$store.getters.getUser.id) === parseInt(this.$route.params.user);
            }
        },
    }
    //好看的全屏背景哦～
    // https://s0.xinger.ink/acgimg/acgurl.php?4 2 app.js:5064:13
    //     https://s0.xinger.ink/acgimg/acgurl.php?11 app.js:5064:13
    //         https://s0.xinger.ink/acgimg/acgurl.php?1 app.js:5064:13
    //             https://s0.xinger.ink/acgimg/acgurl.php?14
</script>
<style lang="scss" scoped>
    h3.sub-maintitle{
        min-height: 35px;
    }
    .main .is-always-shadow{
        box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
    }
    #frontpage .profile{
        display: flex;
        justify-content: right;
        align-items: center;
    }
    #frontpage .profile .name{
        margin-left: 5px;
    }
    #frontpage .front-avatar{
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 40px;
        float: none;
        overflow: hidden;
        background-color: #fff;
        border: 3px solid rgb(64, 158, 255);
        z-index: 100;
        opacity: 1;
        -khtml-opacity: 1;
        -moz-opacity: 1;
        filter: alpha(opacity=100);
        transition: opacity 1s ease-in-out;
        -moz-transition: opacity 1s ease-in-out;
        -webkit-transition: opacity 1s ease-in-out;
    }
    #tab-edit-1 h3{
        margin:5px 0;
    }
    .edit-profile-button{
        margin-top: 15px;
    }
    .effect-input{
        margin-top: 1em;
        box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
    }
    .avatar-uploader{
        margin-top: 1em;
        box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
        background-color: #fff;
        border: 1px dashed #d9d9d9;
        border-radius: 90px;
        box-sizing: border-box;
        width: 178px;
        height: 180px;
        text-align: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        max-width: 320px;
    }
    .avatar-uploader .el-upload__text {
        padding:0 5px;
        color: #606266;
        font-size: 14px;
        text-align: center;
    }
    .avatar-uploader .el-icon-upload {
        font-size: 67px;
        color: #c0c4cc;
        margin: 40px 0 16px;
        line-height: 50px;
    }
    .el-upload__tip {
        font-size: 12px;
        color: #606266;
        margin-top: 7px;
    }
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
        border-radius: 90px;
    }
    /*----------------------------------------------*/
    /* Base Style */
    /*----------------------------------------------*/
    body {
        font-family: 'Open Sans', sans-serif;
        background: url(../../assets/images/main-bg.jpg) center bottom;
        background-size: cover;
        background-color: #E8E8E8;
        margin: 0px;
        padding: 0px;
        font-size: 14px;
        color: #111;
        width: 100%;
        height: 100%;
        overflow: hidden;
        min-height: 100vh;
        background-repeat: no-repeat;
    }
    .h1, .h2, .h3, h1, h2, h3 {
        font-family:'Oswald', sans-serif;
        font-weight: 400;
    }

    /*----------------------------------------------*/
    /* Wrapper */
    /*----------------------------------------------*/
    .container {
        width: 100%;
        position: relative;
        padding-bottom: 15px;
    }

    #content {
        position: relative;
        min-height: 620px;
    }

    .copyright-text {
        float: right;
        margin-right: 15px;
        margin-top: 0px;
    }
    /*-------------------------------------------------------*/
    /* Generic Classes */
    /*-------------------------------------------------------*/
    .abs-child {
        position: relative;
    }

    .hidden {
        display: none;
    }
    .clear {
        clear:both;
    }

    .large-paragraph {
        font-size: 14px;
        line-height: 1.7em;
        letter-spacing: 0.02em;
    }
    .large-paragraph, .focus-text {
        color: #666666;
    }
    .no-padding {
        list-style: none;
        padding-left: 0px;
    }

    .shadow-img {
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        //background-image: url("https://s0.xinger.ink/acgimg/acgurl.php?16");
        /*background: #409eff;*/
        background-size: cover;
        z-index: 0;
    }
    .right-align {
        text-align: right;
    }
    .center-align{
        text-align: center;
    }
    .frontclick {
        position: absolute;
        max-width: 37px;
        bottom: 16px;
        left: 50%;
        transform: translateX(-50%);
        bottom: 15px;
        opacity: 0;
        transition: all .3s;
    }
    .frontclick.active {
        opacity: 1;
    }
    .tlinks{text-indent:-9999px;height:0;line-height:0;font-size:0;overflow:hidden;}
    .pulse {
        background: rgba(0, 0, 0, 0);
        border-radius: 50%;
        height: 14px;
        width: 14px;
        position: absolute;
        margin: 11px 0px 0px -12px;
        -webkit-transform: rotateX(55deg);
        -moz-transform: rotateX(55deg);
        -o-transform: rotateX(55deg);
        -ms-transform: rotateX(55deg);
        transform: rotateX(55deg);
        z-index: -2;
        top: 0px;
        left: 4px;
    }
    .pulse:after {
        content: "";
        border-radius: 50%;
        height: 40px;
        width: 40px;
        position: absolute;
        margin: -13px 0 0 -13px;
        -webkit-animation: pulsate 1s ease-out;
        -moz-animation: pulsate 1s ease-out;
        -o-animation: pulsate 1s ease-out;
        -ms-animation: pulsate 1s ease-out;
        animation: pulsate 1s ease-out;
        -webkit-animation-iteration-count: infinite;
        -moz-animation-iteration-count: infinite;
        -o-animation-iteration-count: infinite;
        -ms-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: alpha(opacity=0);
        -webkit-box-shadow: 0 0 1px 2px #bdbdbd;
        box-shadow: 0 0 1px 2px #bdbdbd;
        -webkit-animation-delay: 1.1s;
        -moz-animation-delay: 1.1s;
        -o-animation-delay: 1.1s;
        -ms-animation-delay: 1.1s;
        animation-delay: 1.1s;
    }
    @-moz-keyframes pulsate {
        0% {
            -webkit-transform: scale(0.1, 0.1);
            -moz-transform: scale(0.1, 0.1);
            -o-transform: scale(0.1, 0.1);
            -ms-transform: scale(0.1, 0.1);
            transform: scale(0.1, 0.1);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
        50% {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }
        100% {
            -webkit-transform: scale(1.2, 1.2);
            -moz-transform: scale(1.2, 1.2);
            -o-transform: scale(1.2, 1.2);
            -ms-transform: scale(1.2, 1.2);
            transform: scale(1.2, 1.2);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
    }
    @-webkit-keyframes pulsate {
        0% {
            -webkit-transform: scale(0.1, 0.1);
            -moz-transform: scale(0.1, 0.1);
            -o-transform: scale(0.1, 0.1);
            -ms-transform: scale(0.1, 0.1);
            transform: scale(0.1, 0.1);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
        50% {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }
        100% {
            -webkit-transform: scale(1.2, 1.2);
            -moz-transform: scale(1.2, 1.2);
            -o-transform: scale(1.2, 1.2);
            -ms-transform: scale(1.2, 1.2);
            transform: scale(1.2, 1.2);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
    }
    @-o-keyframes pulsate {
        0% {
            -webkit-transform: scale(0.1, 0.1);
            -moz-transform: scale(0.1, 0.1);
            -o-transform: scale(0.1, 0.1);
            -ms-transform: scale(0.1, 0.1);
            transform: scale(0.1, 0.1);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
        50% {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }
        100% {
            -webkit-transform: scale(1.2, 1.2);
            -moz-transform: scale(1.2, 1.2);
            -o-transform: scale(1.2, 1.2);
            -ms-transform: scale(1.2, 1.2);
            transform: scale(1.2, 1.2);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
    }
    @keyframes pulsate {
        0% {
            -webkit-transform: scale(0.1, 0.1);
            -moz-transform: scale(0.1, 0.1);
            -o-transform: scale(0.1, 0.1);
            -ms-transform: scale(0.1, 0.1);
            transform: scale(0.1, 0.1);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
        50% {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }
        100% {
            -webkit-transform: scale(1.2, 1.2);
            -moz-transform: scale(1.2, 1.2);
            -o-transform: scale(1.2, 1.2);
            -ms-transform: scale(1.2, 1.2);
            transform: scale(1.2, 1.2);
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }
    }
    /*-------------------------------------------------------*/
    /* Typography */
    /*-------------------------------------------------------*/
    h1 {
        font-size: 45px;
    }
    h2 {
        font-size: 30px;
    }
    h3 {
        font-size: 24px;
    }
    h4 {
        font-size: 15px;
    }
    h5 {
        font-size: 13px;
    }
    h6 {
        font-size: 12px;
    }
    h3.title {
        font-size: 21px;
    }


    h1{color: #409eff; display: block; position: relative;}
    h2{color: #409eff; position: relative;}
    h3{position: relative; margin-bottom: 20px;}
    .invert{color: #fff;}

    strong {
        font-weight: bold;
        color: #333;
    }

    span.year{color: #F9BF3B; float: right;}
    /*.......................................................*/

    /*---------Bootstrap Class Override-----------*/
    .form-group{margin-bottom: 10px;}
    .form-control{border-radius: 0px; padding: 2px 6px;}
    .btn{padding: 2px 25px; border-radius: 0px; }

    .btn-success{
        background: #11E6C8;
        border-color: #11E6C8;
        width: 100%;
        color: #000000;
        font-family: 'Oswald', sans-serif;
        font-size: 18px;
    }
    .btn-success.active,
    .btn-success.focus,
    .btn-success:active,
    .btn-success:focus,
    .btn-success:hover,
    .open>.dropdown-toggle.btn-success {
        opacity: .9;
        background: #11E6C8;
        border-color: #11E6C8;
    }
    .form-control:focus{
        border-color: #888888;
        outline: 0;
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    .modal-content {
        border-radius: 3px;
        border: 8px solid #11E6C8;
        box-shadow: 0 0px 7px rgb(0, 0, 0);
    }
    .modal-body {
        padding: 20px;
    }
    .modal-header {
        background-color: #409eff;
        border-bottom: none;
        padding: 13px 20px 22px;
    }
    .modal-footer {
        padding: 20px;
        border-top: 0;
        padding-top: 0;
    }
    .modal-title {
        display: inline-block;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        margin-bottom: -10px;
        color: #fff;
    }

    .close{
        color: #fff;
        text-shadow: none;
    }
    .modal-header  .close {
        background: rgba(255, 0, 0, 0.83);
        opacity: 1;
        width: 30px;
        height: 30px;
        border-radius: 100%;
        margin-top: 3px;
    }
    /*--------------------------------------------------------*/

    .transparent{
        opacity: 0; 	/* Modern!Firefox 0.9+, Safari 2?, Chrome any?Opera 9+, IE 9+ */
        -khtml-opacity: 0.0;
        -moz-opacity:0.0; 	/* Older than Firefox 0.9 */
        filter: alpha(opacity=0); /* This works in IE 8 & 9 too, but also 5, 6, 7 */

    }

    /*-------------------------------------------------------*/
    /* Front Page Section */
    /*-------------------------------------------------------*/
    .loading-screen{
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #ffffff;
    }
    .loading-avatar{
        border: 4px solid #11E6C8;
        transform: translate(-50%, -50%);
        position: absolute;
        left: 50%;
        top: 50%;
    }
    .loading-introduction{
        margin-top: 55px;
        transform: translate(-50%, -50%);
        position: absolute;
        left: 50%;
        top: 50%;
        font-size: 16px;
        width: 100%;
        text-align: center;
    }
    #frontpage{
        position: relative;
        width: 550px;
        background-color: #28262c;
        text-align: right;
        padding: 15px;
        margin: 0px auto;
        cursor: pointer;
        background-size: contain;
        background-repeat: no-repeat;
    }
    #frontpage .shadow-img{
        background: url("https://s0.xinger.ink/acgimg/acgurl.php?");
    }
    #frontpage .h3{
        font-size: 18px;
    }
    .front-img{
        width: 100%;
        min-height: 150px;
        background-color: #f4d03f;
        text-align: center;
        position: relative;
    }


    /*-------------------------------------------------------*/
    /* Namecard Design Section */
    /*-------------------------------------------------------*/
    #namecard {
        position: relative;
        /*background-image: url("https://s0.xinger.ink/acgimg/acgurl.php?16");*/
        background-color: #666;
        height: 50%;
        min-height: 300px;
        text-align: center;
        padding: 15px;
        margin: 0px;
        margin-bottom: 15px;
    }
    .namecard,
    .namecard h1 {
        font-family: 'Oswald', sans-serif;
    }
    .profile-img{
        position: relative;
        width: 75px;
        height: 75px;
        border-radius: 75px;
        float: none;
        overflow: hidden;
        background-color: #fff;
        border: 4px solid #11E6C8;
        z-index: 100;
        opacity: 1; 	/* Modern!Firefox 0.9+, Safari 2?, Chrome any?Opera 9+, IE 9+ */
        -khtml-opacity: 1.0;
        -moz-opacity: 1.0; 	/* Older than Firefox 0.9 */
        filter: alpha(opacity=100); /* This works in IE 8 & 9 too, but also 5, 6, 7 */

        transition: opacity 1s ease-in-out;
        -moz-transition: opacity 1s ease-in-out;
        -webkit-transition: opacity 1s ease-in-out;
    }



    /*-------------------------------------------------------*/
    /* Menu-Container Design Section */
    /*-------------------------------------------------------*/
    #menu-container{
        position: relative;
        display: block;
        clear: both;
        background-color: #ffffff;
        height: 50%;
        min-height: 305px;
        text-align: right;
        padding: 15px 0px;
        margin: 0px;
    }
    #menu-container li , #menu-container  li span {
        /*display: none;*/
        padding-right: 10px;
    }

    ul.nav-menu li {
        position: relative;
        padding: 12px 0;
        width: 100%;
        color: #409eff;
        border-bottom: 1px solid #e1c03a;
        font-size: 16px;
        margin: 0px;
        font-family: 'Oswald', sans-serif;
        cursor: pointer;
        overflow: hidden;
    }

    .hover-background{
        position: absolute;
        background-color: #409eff;
        z-index: -1;
        width: 300%;
        height: 300%;
        top: 200%;
        left: -100%;
        -ms-transform: rotate(15deg); /* IE 9 */
        -webkit-transform: rotate(15deg); /* Safari */
        -moz-transform: rotate(15deg); /* Safari */
        transform: rotate(15deg);
        -webkit-transition: top 0.5s, left 0.5s; /* Safari */
        -moz-transition: top 0.5s, left 0.5s; /* Safari */
        -o-transition: top 0.5s, left 0.5s; /* Safari */
        transition-timing-function: ease-out;
        transition: top 0.5s, left 0.5s;
    }

    ul.nav-menu li:hover{
        border-bottom-color: #409eff;
        color: #11E6C8;
    }

    ul.nav-menu li:hover .hover-background,ul.nav-menu li.selected .hover-background {
        top: 0%;
        left: -15%;
    }

    ul.nav-menu li.selected{
        background-color: #409eff;
        border-bottom-color: #409eff;
        border-right: none;
        color: #ffffff;
    }

    ul.nav-menu li span {
        border-right: 2px solid #e1c03a;
        margin-right: 0;
        /*text-transform: uppercase;*/
    }

    ul.nav-menu li:hover span,
    ul.nav-menu li.selected span {
        border-right: 2px solid #11E6C8;
    }

    .social-menu-container {
        position: absolute;
        bottom: 0px;
        right: 0px;
        left: 0;
        text-align: center;
    }

    .social-menu-container .title {
        margin-bottom: 5px;
        padding-right: 15px;
        color: #409eff;
    }

    .social-menu {
        display: inline-block;
        float: none;
        font-size: 18px;
        margin-right: 5px;
    }

    .social-menu a{
        color: #409eff;
    }
    .social-menu a:hover{
        color: #11E6C8;
    }
    .social-menu li{
        float: left;
        width: 40px;
        height: 40px;
        text-align: center;
        border-radius:  20px;
        cursor:pointer;
        transition: all 0.1s ease-in;
        -webkit-transition: all 0.1s ease-in;
    }

    .social-menu li:hover{
        background-color: #409eff;
        color: #11E6C8;
    }

    .social-menu li:hover a{
        color: #11E6C8;
    }

    .social-menu li i{
        margin-top: 33%;
    }

    /*-------------------------------------------------------*/
    /* Title-Container Design Section */
    /*-------------------------------------------------------*/
    .page-segment{padding-left: 20px;}
    .page-container{
        margin: 0;
    }
    .title-container{
        position: relative;
        height: 130px;
        background-color: #666;
        margin-bottom: 15px;
        padding: 15px;
        padding-left: 25px;
        z-index: 100;
    }

    .title-container h2{
        bottom: 15px;
        position: absolute;
    }
    .sm-title {
        font-weight: 600;
    }
    h1.maintitle {
        margin-bottom: 3px;
    }
    .sub-maintitle {
        margin-top: 0;
    }
    /*-------------------------------------------------------*/
    /* Description Design Section */
    /*-------------------------------------------------------*/
    .description {
        height: 475px;
        position: relative;
        background-color: #fff;
        padding:0x;
        /*overflow: hidden;*/
    }

    .description p {
        margin: 15px 0px;
        padding-right: 75px;
    }

    .strong-text {
        font-family: 'Oswald', sans-serif;
        display: inline-block;
        font-size: 22.5px;
        margin: 10px 0px;
    }
    .strong-text span {
        background: #11E6C8;
        padding: 2px 5px;
        padding-bottom: 2px;
        color: #111;
        margin-left: 5px;
    }


    .fade-text{
        opacity: 1; 	/* Modern!Firefox 0.9+, Safari 2?, Chrome any?Opera 9+, IE 9+ */
        -khtml-opacity: 1.0;
        -moz-opacity: 1.0; 	/* Older than Firefox 0.9 */
        filter: alpha(opacity=100); /* This works in IE 8 & 9 too, but also 5, 6, 7 */
        transition: opacity 0.75s ease-in;
        -moz-transition: opacity 0.75s ease-in;
        -webkit-transition: opacity 0.75s ease-in;

    }

    .rotate-out{
        -webkit-transform: rotateX(0deg); /* Safari */
        transform: rotateX(0deg);

        transition: all  0.5s ease-in;
        -moz-transition: all 0.5s ease-in;
        -webkit-transition: all 0.5s ease-in;
    }

    .rotated{
        -webkit-transform: rotateX(-90deg); /* Safari */
        transform: rotateX(-90deg);
    }


    .focus-text span {
        font-size: 16px;
        font-weight: 600;
    }

    .page-container .selected{display: block;}

    /*-------------------------------------------------------*/
    /* Home styles	 */
    /*-------------------------------------------------------*/

    .watermark-home{
        width: 321px;
        height: 343px;
        position: absolute;
        bottom: 0px;
        right: 15px;
        background: url(https://mozilan.geekadpt.cn/index.png) no-repeat;
        background-size: contain;
        background-position: right;
    }
    .personal-info-title {
        font-size: 22.5px;
        margin-top: 65px;
    }
    .personal-info {
        list-style: none;
        padding: 0;
    }
    ul.personal-info li {
        margin-bottom: 9px;
        padding-left: 75px;
        position: relative;
        font-size: 12.5px;
    }
    .personal-info span {
        background: #409eff;
        padding: 4px 20px 5px;
        color: #fff;
        display: inline-block;
        margin-left: 9px;
        /*text-transform: capitalize;*/
    }

    .personal-info label {
        position: absolute;
        left: 0;
        width: 75px;
        top: 0;
        bottom: 0;
        min-width: 75px;
        font-size: 12.5px;
        font-weight: 600;
        background: #11E6C8;
        margin-right: 10px;
        padding: 4px 10px 5px;
        margin: 0;
    }

    /*-------------------------------------------------------*/
    /* Resume styles	 */
    /*-------------------------------------------------------*/

    .tabs{
        position: relative;
    }

    .tabs .horizontal{
        margin: 30px -30px;
        margin-top: 0px;
        padding: 10px 0px;
        display: block;
        min-height: 50px;
        position: relative;
        top: -30px;
    }

    .tabs .horizontal li a {
        width: 33.3%;
        border-right: 3px solid #ffffff;
        margin: 0px;
        padding: 24px 0px 19px;
        float: left;
        text-align: center;
        background-color: #409eff;
        color: #11E6C8;
        transition: background-color 0.3s ease-in;
        -webkit-transition: background-color 0.3s ease-in;
        font-size: 16px;
        font-family: Oswald;
    }

    .tabs .horizontal li:last-child a {
        border-right: none;
    }
    .icon-bg {
        background-image: url(../../assets/images/resume/skills.png);
        background-position: left;
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
    }
    .icon-skills {
        background-image: url(../../assets/images/resume/icon_01.png);
    }
    .icon-education {
        background-image: url(../../assets/images/resume/icon_02.png);
    }
    .icon-employment {
        background-image: url(../../assets/images/resume/icon_03.png);
    }
    .tabs .horizontal li a:hover, .tabs .horizontal li.active a{
        background-color: #11E6C8;
        text-decoration: none;
        color: #409eff;
    }

    .tab-cont{
        position: relative;
        height: 300px;
        overflow-y: scroll;
    }

    .tab-cont .row{
        margin-left: 0px;
        margin-right: 0px;
    }

    .employment-class, .education-class{
        list-style: none;
        padding-left: 0px;
    }

    .employment-class li{
        position: relative;
        margin-bottom: 15px;
        background-color: #292e32;
        padding: 15px;
        color: #F7EFE2;
        box-shadow: 0 4px 0 0 rgb(64, 158, 255);
    }

    .employment-class li h4{
        color: #F7EFE2;
        font-size: 13px;
        font-weight: 400;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .employment-class li h5{
        color: #ffffff;
        margin-top: 5px;
        font-weight: bold;
    }

    .employment-class li p{
        margin: 0 0 10px;
        font-size: 12px;
    }

    .employment-class li:last-child:after{
        display: none;
    }

    .education-class li > .title {
        background-color: #409eff;
        padding: 10px;
        font-size: 15px;
        font-weight: 600;
        color: #ffffff;
        cursor: pointer;
    }
    .education-class > li.current > .title {
        background-color: #11E6C8;
        color: #409eff;
    }
    .education-class h4 i{
        font-size: 16px;
    }

    .education-class h4 i.fa-sort-desc{
        position: relative;
        top: -5px;
    }

    .education-class .list-content {
        color: #666;
        padding: 0px 15px;
        height: 0px;
        -webkit-transition: height 0.5s; /* Safari */
        -moz-transition: height 0.5s; /* Mozila */
        -o-transition: height 0.5s; /* Opera */
        transition: height 0.5s;
        overflow: hidden;
    }
    .list-content > .title {
        font-weight: 700;
    }
    .list-year {
        font-style: italic;
        margin-left: 5px;
    }
    .education-class .current .list-content{
        height: 110px;
    }
    .education-class .current i {
        color: #409eff;
    }
    /*skills*/
    .skills-list li {
        margin-bottom: 10px;
    }

    .bar {
        background: #fff6da;
        padding-left: 0px;
        height: 25px;
        overflow: hidden;
        width: 100%;
        /*max-width: 350px;*/
        position: relative;
    }

    .percentage{
        width: 50%;
        height: 100%;
    }
    .circle-skill-container {
        /*max-width: 395px;*/
        padding: 5px;
        padding-left: 0;
    }
    .circle-skill-container h5 {
        margin-top: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .circle-bar{
        position: relative;
        margin: 5px auto;
    }

    .circle-bar > svg {
        height: 100%;
        display: block;
    }

    .circle-bar .progressbar-text{
        font-size: 12.5px;
        position: absolute;
        top: 50%;
        left: 50%;
        padding: 0px;
        margin: 0px;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: #409eff;
    }

    /*-------------------------------------------------------*/
    /* Contact Page styles	 */
    /*-------------------------------------------------------*/

    .mail-container{
        background-color: #409eff;
        padding: 5px 30px;
        display: block;
        position: relative;
        top: -150px;
        /*max-width: 250px;*/
    }
    .mail-container >.title {
        text-transform: uppercase;
        margin-left: -15px;
        margin-right: -15px;
    }
    .map-container{
        position: relative;
        height: 305px;
        overflow: hidden;
        margin-left: -14px;
        margin-right: -14px;
    }

    span.address-icon{
        width: 23px;
        font-size: 13px;
        float: left;
        position: relative;
    }
    .cnmail {
        position: absolute;
        top: -48px;
        background: #11E6C8;
        left: 0;
        width: 100%;
    }
    .cnmail .msg {
        padding: 5px;
        display: none;
    }

    .mail-sucsess {
        text-transform: uppercase;
        color: #006b0a;
    }
    .mail-sucsess h3 {
        color: #006b0a;
    }

    

    /*-------------------------------------------------------*/
    /* Styles for Portfolio Page   */
    /*-------------------------------------------------------*/

    /* generic css */
    .sec-porfolio.description {
        padding: 70px 34px 15px 40px;
    }
    .button-group.filters-button-group {
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 1;
    }

    .button-group {
        list-style: none;
        padding-left:0px;
        width: 100%;
        margin: 0px;
        display: table;
    }

    .button-group .button {
        text-align: center;
        float: left;
        width: 25%;
        background: #409eff;
        border-right: 2px solid #fff;
        color: #11E6C8;
        padding: 12px 0px;
        cursor: pointer;
        transition: background-color 0.5s ease-in;
        -webkit-transition: background-color 0.5s ease-in;
    }
    .filters-button-group li {
        font-size: 16px;
    }
    .button-group .button.is-checked{
        color: #111;
        background-color: #11E6C8;
    }

    .demo-2 .button-group .button.is-checked{
        color: #2C3E50;
        background-color: #11E6C8;
    }

    .demo-2 .button-group .button{
        background: #2C3E50;
    }

    .button-group .button:hover{
        background-color: #11E6C8;
        color: #fff;

    }

    .folio-container{
        height: 380px;
        overflow-y: scroll;
        padding-bottom: 40px;
    }

    .folio-item{
        position: relative;
        list-style: none;
        padding-left: 0px;
    }

    .view {
        margin: 1px;
        float: left;
        overflow: hidden;
        position: relative;
        text-align: center;
        width: 32.5%;
        height: 150px;
        cursor: default;
        background: #242424 no-repeat center center;
    }

    .view .mask, .view .content {
        width: 100%;
        height: 100%;
        position: absolute;
        overflow: hidden;
        top: 0;
        left: 0
    }
    .view img {
        display: block;
        position: relative;
        width: auto;
        max-width: 100%;
        height: 100%;
    }

    .view h2 {
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        text-align: center;
        position: relative;
        font-size: 17px;
        padding: 10px;
        margin: 20px 40px 0px 40px;
    }

    .view a.info {
        display: inline-block;
        text-decoration: none;
        padding: 7px 14px;
        background: #000;
        color: #fff;
        text-transform: uppercase;
        box-shadow: 0 0 1px #000;
        margin-top: 10px;
    }
    .view a.info:hover {
        box-shadow: 0 0 5px #000;
        background-color: #11E6C8;
        color: #212129;
    }

    /*1*/

    .view-first img { /*1*/
        transition: all 0.2s linear;
    }

    .view-first .mask {
        opacity: 0;
        background-color: rgba(12, 19, 27, 0.6);
        transition: all 0.4s ease-in-out;

    }
    .view-first h2 {
        transform: translateY(-100px);
        opacity: 0;
        transition: all 0.2s ease-in-out;
    }
    .view-first a.info{
        opacity: 0;
        transition: all 0.2s ease-in-out;
    }

    /* */

    .view-first:hover img {
        transform: scale(1.1);
    }
    .view-first:hover .mask {
        opacity: 1;
    }
    .view-first:hover h2,
    .view-first:hover p,
    .view-first:hover a.info {
        opacity: 1;
        transform: translateY(0px);
    }

    .view-first:hover a.info {
        transition-delay: 0.2s;
    }

    /*2*/

    .view-second img {
        transition: all 0.2s ease-in;
        -webkit-transition: all 0.2s ease-in;
    }
    .view-second .mask {
        background-color: rgba(12, 19, 27, 0.6);
        width: 100%;
        padding: 260px;
        height: 100%;
        opacity: 0;
        transform: translate(265px, 145px) rotate(45deg);
        -webkit-transform: translate(265px, 145px) rotate(45deg);
        transition: all 0.2s ease-in-out;
        -webkit-transition: all 0.2s ease-in-out;
    }
    .view-second h2 {
        background: transparent;
        -webkit-transform: translate(200px, -200px);
        transform: translate(200px, -200px);
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .view-second a.info {
        transform: translate(0px, 160px);
        -webkit-transform: translate(0px, 160px);
        transition: all 0.2s 0.1s ease-in-out;
        -webkit-transition: all 0.2s 0.1s ease-in-out;
    }



    .view-second:hover .mask {
        opacity:1;
        transform: translate(-80px, -125px) rotate(45deg);
        -webkit-transform: translate(-80px, -125px) rotate(45deg);
    }
    .view-second:hover h2 {
        transform: translate(0px,0px);
        -webkit-transform: translate(0px,0px);
        transition-delay: 0.3s;
        -webkit-transition-delay: 0.3s;
    }

    .view-second:hover a.info {
        transform: translate(0px,0px);
        -webkit-transform: translate(0px,0px);
        transition-delay: 0.5s;
        -webkit-transition-delay: 0.5s;
    }

    .view-tenth img {
        transform: scaleY(1);
        transition: all .7s ease-in-out;
    }
    .view-tenth .mask {
        background-color: rgba(12, 19, 27, 0.6);
        transition: all 0.5s linear;
        opacity: 0;
    }
    .view-tenth h2{
        background: transparent;
        margin: 20px 40px 0px 40px;
        transform: scale(0);
        color: #fff;
        transition: all 0.5s linear;
        opacity: 0;
    }

    .view-tenth a.info {
        opacity: 0;
        transform: scale(0);
        transition: all 0.5s linear;
    }


    .view-tenth:hover img {
        -webkit-transform: scale(10);
        transform: scale(10);
        opacity: 0;
    }

    .view-tenth:hover .mask {
        opacity: 1;
    }
    .view-tenth:hover h2,
    .view-tenth:hover p,
    .view-tenth:hover a.info{
        transform: scale(1);
        opacity: 1;
    }
    /* portfolio modal style*/
    .mf-content {
        text-align: left;

    }

    @media (max-width: 767px) {
        .description{
            padding: 0;
        }
        .view {
            width: 49%;
            height: 210px;
        }
        .category-nav li{
            width: 50%;
        }

        .folio-container{
            height: auto;
            overflow: hidden;
        }
    }

    @media (max-width: 460px) {
        .view {
            width: 47%;
            height: 160px;
        }
    }



    /*-------------------------------------------------------*/
    /* Mobile Sociail Nav styles	 */
    /*-------------------------------------------------------*/

    .mobile-nav-container{
        background-color: #666;
        margin: 15px 0px;
        display: none;
    }


    .mobile-social{
        float: right;
        width: auto;
        color: #11E6C8;
        font-size: 15px;
        margin-bottom: 0px;
    }

    .mobile-social li{
        float: left;
        margin: 10px;
    }

    .mobile-social a{
        color: #F7EFE2;
    }

    .mobile-social a:hover{
        color: #11E6C8;
    }

    /*-------------------------------------------------------*/
    /* Responsive Fix for under 767px*/
    /*-------------------------------------------------------*/
    @media(max-width: 767px) {
        body {
            height: auto;
            min-height: 1000px;
            overflow-y: scroll;
        }
        #frontpage {
            width: auto;
            margin: 0px 15px;
        }
        ul.nav-menu li span {
            border-right: 0;
            margin-right: 15px;
            /*text-transform: uppercase;*/
        }
        ul.nav-menu li:hover span,
        ul.nav-menu li.selected span {
            border-right: 0;
        }
        ul.nav-menu li{
            padding: 5px;
        }
        #namecard {
            text-align: center;
        }
        .profile-img {
            float: none;
            margin-left: auto;
            margin-right: auto;
        }
        .page-segment {
            padding-left: 0;
            margin-top: 15px;
        }
        #menu-container {
            min-height: 60px;
            padding: 0px;
        }
        #menu-container li , #menu-container  li span {
            /*display: none;*/
            padding-right: 0;
        }
        ul.nav-menu li {
            width: 25%;
            margin: 0px;
            padding: 15px;
            /*font-size: 19px;*/
            float: left;
            text-align: center;
            border-right: 1px solid #e1c03a;
            border-bottom: none;
        }
        ul.nav-menu li.selected {
            border-bottom: 3px solid #409eff;
            border-right: none;
        }
        .hover-background {
            top: 200%;
            left: -50%;
        }
        ul.nav-menu li:hover .hover-background {
            left: -25%;
        }
        .social-menu-container {
            display: none;
        }
        .description {
            height: auto;
        }
        .tab-cont {
            height: auto;
            overflow: hidden;
        }
        .circle-bar {
            margin-bottom: 25px;
            /*max-height: 110px;*/
        }
        .education-class .current .list-content {
            height: 130px;
        }
        .mail-container {
            max-width: 120%;
            top: 15px;
            margin: 0px -15px;
        }
        .map-container {
            margin: 0px;
        }
        .mobile-nav-container {
            display: block;
        }
        .mobile-social {
            float: none;
        }
        .watermark-home{
            background-position: 100px;
        }
        .title-container{
            display: none;
        }
    }
</style>
