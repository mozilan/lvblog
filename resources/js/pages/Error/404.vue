<style lang="scss" scoped>
    #chang-jian-ye-mian-bu-ju + .demo-container .el-footer, #chang-jian-ye-mian-bu-ju + .demo-container .el-header {
        text-align: center;
    }
    #chang-jian-ye-mian-bu-ju + .demo-container .el-main {
        background-color: #ffffff;
        color: #333;
        text-align: center;
        line-height: 160px;
    }
    pre {
        border-radius: 2px;
        position: relative;
    }
    pre code {
        overflow-x: auto;
        color: #525252;
        white-space: pre;
        padding: 1.2em 1.4em;
        font-size: 0.85rem;
        line-height: 1.6rem;
        display: block;
    }
    pre code .hljs-tag,
    pre code .hljs-tag pre code .hljs-title,
    pre code .hljs-change,
    pre code .hljs-winutils,
    pre code .hljs-flow,
    pre code .hljs-tex pre code .hljs-special {
        color: #2973b7;
    }
    pre code .hljs-symbol,
    pre code .hljs-symbol pre code .hljs-string,
    pre code .hljs-value,
    pre code .hljs-regexp,
    pre code .hljs-string,
    pre code .hljs-subst,
    pre code .hljs-haskell pre code .hljs-type,
    pre code .hljs-preprocessor,
    pre code .hljs-ruby pre code .hljs-class pre code .hljs-parent,
    pre code .hljs-built_in,
    pre code .hljs-sql pre code .hljs-aggregate,
    pre code .hljs-django pre code .hljs-template_tag,
    pre code .hljs-django pre code .hljs-variable,
    pre code .hljs-smalltalk pre code .hljs-class,
    pre code .hljs-javadoc,
    pre code .hljs-django pre code .hljs-filter pre code .hljs-argument,
    pre code .hljs-smalltalk pre code .hljs-localvars,
    pre code .hljs-smalltalk pre code .hljs-array,
    pre code .hljs-attr_selector,
    pre code .hljs-pseudo,
    pre code .hljs-addition,
    pre code .hljs-stream,
    pre code .hljs-envvar,
    pre code .hljs-apache pre code .hljs-tag,
    pre code .hljs-apache pre code .hljs-cbracket,
    pre code .hljs-tex pre code .hljs-command,
    pre code .hljs-prompt {
        color: #42b983;
    }
    pre code .hljs-function pre code .hljs-keyword,
    pre code .hljs-constant {
        color: #0092db;
    }
    pre code .hljs-keyword,
    pre code .hljs-attribute {
        color: #d63200;
    }
    pre code .hljs-number,
    pre code .hljs-literal {
        color: #a32eff;
    }
    pre code .hljs-class pre code .hljs-title {
        color: #fff;
    }
    pre code .hljs-title {
        color: #a6e22e;
    }
    pre code .hljs-tag pre code .hljs-value,
    pre code .hljs-comment,
    pre code .hljs-java pre code .hljs-annotation,
    pre code .hljs-python pre code .hljs-decorator,
    pre code .hljs-template_comment,
    pre code .hljs-pi,
    pre code .hljs-doctype,
    pre code .hljs-deletion,
    pre code .hljs-shebang,
    pre code .hljs-apache pre code .hljs-sqbracket,
    pre code .hljs-tex pre code .hljs-formula {
        color: #707070;
    }
    pre code .hljs-coffeescript pre code .hljs-javascript,
    pre code .hljs-javascript pre code .hljs-xml,
    pre code .hljs-tex pre code .hljs-formula,
    pre code .hljs-xml pre code .hljs-javascript,
    pre code .hljs-xml pre code .hljs-vbscript,
    pre code .hljs-xml pre code .hljs-css,
    pre code .hljs-xml pre code .hljs-cdata {
        opacity: 0.5;
    }
    pre code.hljs.html::before,
    pre code.hljs.js::before,
    pre code.hljs.bash::before,
    pre code.hljs.css::before {
        /*font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;*/
        position: absolute;
        top: 0;
        right: 0;
        color: #ccc;
        text-align: right;
        font-size: 0.9em;
        padding: 5px 10px 0;
        line-height: 15px;
        height: 15px;
        font-weight: 600;
    }
    pre code.hljs.html::before {
        content: "HTML";
    }
    pre code.hljs.js::before {
        content: "JS";
    }
    pre code.hljs.bash::before {
        content: "Shell";
    }
    pre code.hljs.css::before {
        content: "CSS";
    }
    #ad a {
        display: inline-block;
        color: #4f5959;
        font-weight: normal;
    }
    #ad span {
        color: #4f5959;
        display: block;
    }
    #ad img {
        width: 125px;
    }
    #ad .carbon-img,
    #ad .carbon-text {
        display: block;
        margin-bottom: 4px;
        font-weight: normal;
        color: #304455;
    }
    #ad .carbon-poweredby {
        color: #aaa;
        font-size: 10px;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        font-weight: normal;
    }
    #bsa-native .native-box {
        box-shadow: inset 0 0 0 1px rgba(0,0,0,0.075);
        background-color: #f8f8f8;
        color: #304455;
        display: flex;
        border-radius: 3px;
        padding: 0.65em 1em;
        align-items: center;
        margin-bottom: 1.2em;
    }
    #bsa-native .native-box .native-link {
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 10px 14px;
    }
    #bsa-native .native-box .native-sponsor {
        background-color: #41b983;
        color: #fff;
        font-size: 12px;
        border-radius: 2px;
        margin-right: 1em;
        line-height: 1;
        padding: 6px 10px;
        font-weight: 600;
        text-transform: uppercase;
    }
    #bsa-native .native-box .native-text {
        font-weight: normal;
        line-height: 1.35;
        text-align: left;
    }
    @media print {
        #ad {
            display: none;
        }
    }
    body {
        /*font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;*/
        font-size: 1rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #304455;
        background-color: #fff;
        margin: 0;
    }
    @media screen and (max-width: 900px) {
        body.docs {
            padding-top: 0;
        }
    }
    a {
        text-decoration: none;
        color: #304455;
    }
    img {
        border: none;
    }
    h1,
    h2,
    h3,
    h4,
    strong {
        font-weight: 600;
        color: #273849;
    }
    code,
    pre {
        /*font-family: "Roboto Mono", Monaco, courier, monospace;*/
        font-size: 0.85em;
        background-color: #f8f8f8;
        -webkit-font-smoothing: initial;
        -moz-osx-font-smoothing: initial;
    }
    code {
        color: #d63200;
        padding: 3px 5px;
        margin: 0 2px;
        border-radius: 2px;
        white-space: nowrap;
    }
    em {
        color: #4f5959;
    }
    p {
        word-spacing: 0.05em;
    }
    a.button,
    input.button {
        padding: 0.75em 2em;
        border-radius: 2em;
        display: inline-block;
        color: #fff;
        background-color: #4fc08d;
        transition: all 0.15s ease;
        box-sizing: border-box;
        border: 1px solid #4fc08d;
    }
    a.button.has-icon,
    input.button.has-icon {
        position: relative;
        text-indent: 1.4em;
    }
    a.button.has-icon > svg,
    input.button.has-icon > svg {
        position: absolute;
        left: 0.4em;
        top: 0.4em;
        width: 2em;
    }
    a.button.white,
    input.button.white {
        background-color: #fff;
        color: #42b983;
    }
    a.button.gray,
    input.button.gray {
        background-color: #f6f6f6;
        color: #4f5959;
        border-color: #f6f6f6;
    }
    #nav .nav-link {
        cursor: pointer;
    }
    #nav .nav-dropdown-container .nav-link:hover:not(.current) {
        border-bottom: none;
    }
    #nav .nav-dropdown-container:hover .nav-dropdown {
        display: block;
    }
    #nav .nav-dropdown-container.language,
    #nav .nav-dropdown-container.ecosystem {
        margin-left: 20px;
    }
    #nav .nav-dropdown-container .arrow {
        pointer-events: none;
    }
    #nav .nav-dropdown {
        display: none;
        box-sizing: border-box;
        max-height: calc(100vh - 61px);
        overflow-y: auto;
        position: absolute;
        top: 100%;
        right: -15px;
        background-color: #fff;
        padding: 10px 0;
        border: 1px solid #ddd;
        border-bottom-color: #ccc;
        text-align: left;
        border-radius: 4px;
        white-space: nowrap;
    }
    #nav .nav-dropdown li {
        line-height: 1.8em;
        margin: 0;
        display: block;
    }
    #nav .nav-dropdown li > ul {
        padding-left: 0;
    }
    #nav .nav-dropdown li:first-child h4 {
        margin-top: 0;
        padding-top: 0;
        border-top: 0;
    }
    #nav .nav-dropdown a,
    #nav .nav-dropdown h4 {
        padding: 0 24px 0 20px;
    }
    #nav .nav-dropdown h4 {
        margin: 0.45em 0 0;
        padding-top: 0.45em;
        border-top: 1px solid #eee;
    }
    #nav .nav-dropdown a {
        color: #354c63;
        display: block;
    }
    #nav .nav-dropdown a:hover {
        color: #42b983;
    }
    #nav .arrow {
        display: inline-block;
        vertical-align: middle;
        margin-top: -1px;
        margin-left: 6px;
        margin-right: -14px;
        width: 0;
        height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid #4f5959;
    }
    sup.beta.beta {
        font-size: 0.6em;
        margin-left: 0.7em;
        text-transform: uppercase;
        opacity: 0.6;
    }
    @media print {
        body {
            color: #000;
        }
        .highlight {
            padding: 0;
            page-break-inside: avoid;
        }
        .highlight .code pre {
            color: #000;
            background-color: #fff;
            border-style: solid;
            border-width: 2px 2px 2px 2px;
            border-color: #e8e8e8;
            page-break-inside: avoid;
        }
        h1,
        h2,
        h3,
        h4,
        h5 {
            color: #000;
            page-break-after: avoid;
            page-break-before: avoid;
        }
        img {
            page-break-inside: avoid;
        }
        h2+p {
            page-break-before: avoid;
        }
        a:link:after,
        a:visited:after {
            content: " [" attr(href) "] ";
        }
    }
    #header {
        background-color: #fff;
        height: 40px;
        padding: 10px 60px;
        position: relative;
        z-index: 100;
    }
    body.docs #header {
        position: fixed;
        width: 100%;
        top: 0;
    }
    body.docs #nav {
        position: fixed;
    }
    #nav {
        list-style-type: none;
        margin: 0;
        padding: 0;
        position: absolute;
        right: 30px;
        top: 10px;
        height: 40px;
        line-height: 40px;
    }
    #nav .break {
        display: none;
    }
    #nav li {
        display: inline-block;
        position: relative;
        margin: 0 0.6em;
    }
    #nav .nav-dropdown .nav-link:hover,
    #nav .nav-dropdown .nav-link.current {
        border-bottom: none;
    }
    #nav .nav-dropdown .nav-link.current::after {
        content: "";
        width: 0;
        height: 0;
        border-left: 5px solid #42b983;
        border-top: 3px solid transparent;
        border-bottom: 3px solid transparent;
        position: absolute;
        top: 50%;
        margin-top: -4px;
        left: 8px;
    }
    #nav .nav-dropdown .nav-link.new::before {
        content: "";
        width: 0;
        height: 0;
        border: 2px solid #f66;
        border-radius: 50%;
        position: absolute;
        top: calc(50% - 1px);
        left: 8px;
    }
    .nav-link {
        padding-bottom: 3px;
        white-space: nowrap;
    }
    .nav-link:hover,
    .nav-link.current {
        border-bottom: 3px solid #42b983;
    }
    .nav-link.team,
    .nav-link.contribute {
        margin-left: 10px;
    }
    .nav-link.new::before {
        content: "";
        width: 0;
        height: 0;
        border: 2px solid #f66;
        border-radius: 50%;
        position: absolute;
        top: calc(50% - 1px);
        left: -8px;
    }
    .new-label {
        position: absolute;
        top: 3px;
        left: 110%;
        background-color: #42b983;
        color: #fff;
        line-height: 16px;
        height: 16px;
        font-size: 9px;
        font-weight: bold;
        /*font-family: "Roboto Mono", Monaco, courier, monospace;*/
        padding: 1px 4px 0 6px;
        border-radius: 4px;
    }
    .search-query {
        height: 30px;
        line-height: 30px;
        box-sizing: border-box;
        padding: 0 15px 0 30px;
        border: 1px solid #e3e3e3;
        color: #273849;
        outline: none;
        border-radius: 15px;
        margin-right: 10px;
        transition: border-color 0.2s ease;
        /*background: #fff url("../images/search.png") 8px 5px no-repeat;*/
        background-size: 20px;
        vertical-align: middle !important;
    }
    .search-query:focus {
        border-color: #42b983;
    }
    #logo {
        display: inline-block;
        font-size: 1.5em;
        line-height: 40px;
        color: #273849;
        /*font-family: "Dosis", "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;*/
        font-weight: 500;
    }
    #logo img {
        vertical-align: middle;
        margin-right: 6px;
        width: 40px;
        height: 40px;
    }
    #mobile-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background-color: #fff;
        z-index: 9;
        display: none;
        box-shadow: 0 0 2px rgba(0,0,0,0.25);
    }
    #mobile-bar .menu-button {
        position: absolute;
        width: 24px;
        height: 24px;
        top: 8px;
        left: 12px;
        /*background: url("../images/menu.png") center center no-repeat;*/
        background-size: 24px;
    }
    #mobile-bar .logo {
        position: absolute;
        width: 30px;
        height: 30px;
        /*background: url("../images/logo.png") center center no-repeat;*/
        top: 5px;
        left: 50%;
        margin-left: -15px;
        background-size: 30px;
    }
    @media print {
        #header {
            /*display: none;*/
        }
    }
    .sidebar {
        position: absolute;
        z-index: 10;
        top: 61px;
        left: 0;
        bottom: 0;
        overflow-x: hidden;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: none;
    }
    .sidebar h2 {
        margin-top: 0.2em;
    }
    .sidebar ul {
        list-style-type: none;
        margin: 0;
        line-height: 1.5em;
        padding-left: 1em;
    }
    .sidebar li {
        margin-top: 0.5em;
    }
    .sidebar .sidebar-inner {
        width: 260px;
        padding: 70px 0px 60px 20px;
    }
    .sidebar .version-select {
        vertical-align: middle;
        margin-left: 5px;
    }
    .sidebar .menu-root {
        padding-left: 0;
    }
    .sidebar .sidebar-link {
        color: #4f5959;
    }
    .sidebar .sidebar-link.current {
        font-weight: 600;
        color: #42b983;
    }
    .sidebar .sidebar-link.new:after {
        content: "NEW";
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        color: #fff;
        background-color: #42b983;
        line-height: 14px;
        padding: 0 4px;
        border-radius: 3px;
        margin-left: 5px;
        vertical-align: middle;
        position: relative;
        top: -1px;
    }
    .sidebar .sidebar-link:hover {
        border-bottom: 2px solid #42b983;
    }
    .sidebar .section-link.active {
        font-weight: bold;
        color: #42b983;
    }
    .sidebar .main-menu {
        margin-bottom: 20px;
        display: none;
        padding-left: 0;
    }
    .sidebar .nav-dropdown h4 {
        font-weight: normal;
        margin: 0;
    }
    @media screen and (max-width: 900px) {
        .sidebar {
            position: fixed;
            z-index: 10;
            background-color: #f9f9f9;
            height: 100%;
            top: 0;
            left: 0;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0, 1);
            -webkit-transform: translate(-280px, 0);
            transform: translate(-280px, 0);
        }
        .sidebar .sidebar-inner {
            padding: 50px 10px 10px 20px;
            box-sizing: border-box;
        }
        .sidebar .sidebar-inner-index {
            padding: 10px 10px 10px 20px;
        }
        .sidebar .search-query {
            width: 200px;
            margin-bottom: 10px;
        }
        .sidebar .main-menu {
            display: block;
        }
        .sidebar.open {
            -webkit-transform: translate(0, 0);
            transform: translate(0, 0);
        }
    }
    @media print {
        .sidebar {
            display: none;
        }
    }
    #sponsors {
        text-align: center;
        padding: 35px 40px 45px;
        background-color: #f6f6f6;
    }
    #sponsors .inner {
        max-width: 700px;
        margin: 0px auto;
    }
    #sponsors h3 {
        color: #999;
        margin: 0 0 10px;
    }
    #sponsors a {
        margin: 20px 15px 0;
        position: relative;
    }
    #sponsors a,
    #sponsors img {
        width: 100px;
        display: inline-block;
        vertical-align: middle;
    }
    #sponsors img {
        transition: all 0.3s ease;
        filter: grayscale(100%);
        opacity: 0.66;
    }
    #sponsors img:hover {
        filter: none;
        opacity: 1;
    }
    #sponsors a.vip {
        display: block;
        margin: 30px auto 15px;
        width: 200px;
    }
    #sponsors a.vip img {
        width: 200px;
    }
    #sponsors .become-sponsor {
        margin-top: 40px;
        font-size: 0.9em;
        font-weight: 700;
        width: auto;
        background-color: transparent;
    }
    #sponsors .open-collective-sponsors {
        margin-top: 60px;
    }
    #sponsors .open-collective-sponsors a,
    #sponsors .open-collective-sponsors img {
        width: auto;
        max-width: 100px;
        max-height: 60px;
    }
    #sponsors .open-collective-sponsors h4 {
        color: #999;
        margin-bottom: 0;
    }
    #sponsors.active img {
        filter: none;
        opacity: 1;
    }
    #special-sponsor .become-backer {
        color: #42b983;
        border: 1px solid #42b983;
        border-radius: 2em;
        display: inline-block;
        color: #42b983;
        font-size: 0.8em;
        width: 125px;
        padding: 4px 0;
        text-align: center;
        margin: 20px 0 0;
    }
    .modal {
        box-sizing: border-box;
        display: none;
        position: fixed;
        width: 80%;
        height: auto;
        padding: 0.5em;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        z-index: 102;
    }
    .modal.open {
        display: block;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
    }
    .modal-text {
        margin-bottom: 0.5em;
        text-align: center;
    }
    .modal-text > a {
        color: #42b983;
        font-weight: 600;
    }
    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.2);
        z-index: 101;
    }
    .stop-scroll {
        overflow: hidden;
        height: 100%;
    }
    @media screen and (max-width: 400px) {
        .modal {
            width: 98%;
        }
    }
    .themes-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .themes-grid .item-preview {
        width: 290px;
        margin-bottom: 25px;
    }
    .themes-grid .item-preview-img {
        transition: 0.15s box-shadow, 0.15s transform;
        border-radius: 0.5rem;
        box-shadow: 0 2rem 1.5rem -1.5rem rgba(33,37,41,0.15), 0 0 1.5rem 0.5rem rgba(33,37,41,0.05);
        overflow: hidden;
        display: block;
    }
    .themes-grid .item-preview-img:hover {
        transform: translateY(-0.25rem);
        box-shadow: 0 2.25rem 1.5rem -1.5rem rgba(33,37,41,0.2), 0 0 1.5rem 0.5rem rgba(33,37,41,0.05);
    }
    .themes-grid img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        vertical-align: middle;
        border-style: none;
    }
    .themes-grid .item-preview-title-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .themes-grid h3.item-preview-title {
        margin-top: 0.7rem;
        margin-bottom: 0;
    }
    .themes-grid h3.item-preview-title.free::after {
        content: "FREE";
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        color: #fff;
        background-color: #42b983;
        line-height: 14px;
        padding: 0 4px;
        border-radius: 3px;
        margin-left: 5px;
        vertical-align: middle;
        position: relative;
        top: -1px;
    }
    .themes-grid .item-preview-price {
        margin-top: 0.7rem;
    }
    .themes-grid .item-preview-description {
        font-size: 0.9rem;
    }
    .themes-grid .see-more-container {
        display: flex;
        justify-content: center;
        width: 100%;
    }
    .themes-grid .see-more-container .see-more-link {
        color: #42b983;
    }
    @media screen and (max-width: 1300px) {
        .themes-grid {
            justify-content: center;
        }
        .themes-grid .item-preview {
            justify-content: center;
            width: 380px;
        }
    }
    /*body {*/
    /*background-color: #475050;*/
    /*}*/
    #logo span {
        font-size: 1.2em;
    }
    #logo img {
        display: none;
    }
    .sidebar {
        display: none;
    }
    #mobile-bar.top {
        background-color: transparent;
        box-shadow: none;
    }
    #mobile-bar.top .logo {
        display: none;
    }
    #news {
        padding: 40px 40px 30px;
        background-color: #fff;
    }
    #hero .inner,
    #news .inner {
        max-width: 1260px;
        margin: 0 auto;
    }
    #hero .left,
    #news .left,
    #hero .right,
    #news .right {
        display: inline-block;
        vertical-align: top;
    }
    #hero .left,
    #news .left {
        width: 39%;
    }
    #hero .right,
    #news .right {
        width: 61%;
    }
    #hero .hero-logo,
    #news .hero-logo {
        width: 215px;
        height: 215px;
        float: right;
        margin-right: 60px;
    }
    #hero h1,
    #news h1 {
        font-weight: 300;
        margin: 0;
        font-size: 3.2em;
    }
    #hero h2,
    #news h2 {
        /*font-family: "Dosis", "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;*/
        font-weight: 500;
        font-size: 2.4em;
        margin: 0 0 10px;
        display: none;
    }
    #hero .button,
    #news .button {
        margin: 1em 0;
        font-size: 1.05em;
        font-weight: 600;
        letter-spacing: 0.1em;
        min-width: 8em;
        text-align: center;
    }
    #hero .button:not(:last-child),
    #news .button:not(:last-child) {
        margin-right: 1%;
    }
    #hero .social-buttons,
    #news .social-buttons {
        list-style-type: none;
        padding: 0;
    }
    #hero .social-buttons li,
    #news .social-buttons li {
        display: inline-block;
        vertical-align: middle;
        margin-right: 15px;
    }
    #news {
        padding: 40px 20px 70px;
        text-align: center;
    }
    #news p {
        margin-top: 10px;
    }
    #news a {
        color: #42b983;
    }
    #news .newsletter-form {
        position: relative;
        max-width: 550px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    #news .newsletter-input {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 80px 10px 20px;
        height: 50px;
        border-radius: 50px;
        border: 1px solid #ccc;
        font-size: 16px;
    }
    #news .newsletter-input:focus {
        outline: none;
        border-color: #42b983;
    }
    #news .newsletter-button.button {
        position: absolute;
        padding: 4px 20px;
        margin: 0;
        height: calc(100% - 8px);
        right: 4px;
        top: 4px;
    }
    #special-sponsor {
        background-color: #fff;
        text-align: center;
        padding-bottom: 30px;
    }
    #special-sponsor h3 {
        margin: 0;
    }
    #special-sponsor a {
        color: #4f5959;
    }
    #special-sponsor a,
    #special-sponsor span,
    #special-sponsor img {
        display: inline-block;
        vertical-align: middle;
    }
    #special-sponsor img {
        margin: 15px;
    }
    #highlights {
        background-color: #fff;
        padding-bottom: 70px;
    }
    #highlights .inner {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
    }
    #highlights .point {
        width: 33%;
        display: inline-block;
        vertical-align: top;
        box-sizing: border-box;
        padding: 0 2em;
    }
    #highlights .point h2 {
        color: #42b983;
        font-size: 1.5em;
        font-weight: 400;
        margin: 0;
        padding: 0.5em 0;
    }
    #highlights .point p {
        color: #4f5959;
    }
    #footer {
        padding: 40px 0;
        color: #fff;
        text-align: center;
    }
    #footer .social-icon {
        margin: 0 5px;
    }
    #footer .social-icon svg {
        width: 18px;
        height: 18px;
    }
    #footer a {
        font-weight: 700;
        color: #fff;
    }
    @media screen and (max-width: 900px) {
        body {
            -webkit-text-size-adjust: none;
            font-size: 14px;
        }
        .sidebar {
            display: block;
        }
        /*#header {*/
        /*display: none;*/
        /*}*/
        #mobile-bar {
            display: block;
        }
        #hero {
            padding: 40px 40px 30px;
        }
        #hero .hero-logo {
            float: none;
            margin: 30px 0 15px;
            width: 140px;
            height: 140px;
        }
        #hero .left,
        #hero .right {
            text-align: center;
            width: 100%;
        }
        #hero h1 {
            font-size: 2em;
        }
        #hero h2 {
            display: block;
        }
        #hero .button {
            font-size: 0.9em;
        }
        #special-sponsor span {
            display: block;
        }
        #special-sponsor img {
            width: 125px;
        }
        #highlights .point {
            display: block;
            margin: 0 auto;
            width: 300px;
            padding: 0 40px 30px;
        }
        #highlights .point:before {
            content: "—";
            color: #42b983;
        }
    }
    @media only screen and (max-width: 683px){
        .breadcrumb{
            padding-top:0;
        }
    }
</style>
<template>
    <div id="error" class="error el-scrollbar__wrap">
        <Navigation></Navigation>
        <div class="lv-container">
            <div class="error">
                <div id="hero">
                    <div class="inner">
                        <div class="left">
                            <img class="hero-logo" src="https://mozilan.geekadpt.cn/logo.png" alt="lvblog logo">
                        </div><div class="right">
                        <h2 class="vue">LvBlog</h2>
                        <h1>{{this.$route.query.code?this.$route.query.code:'404'}}</h1><br>
                        <h3 style="margin:0;font-size:2em">{{this.$route.query.message?this.$route.query.message:'页面找不到了'}}</h3>
                        <p>
                            <router-link :to="{ name:'首页' }" id="modal-player" class="button has-icon">
                                <svg aria-labelledby="simpleicons-play-icon" role="img" viewBox="0 0 100 125" fill="#FFFFFF"><title id="simpleicons-play-icon" lang="en">Play icon</title><path d="M50,3.8C24.5,3.8,3.8,24.5,3.8,50S24.5,96.2,50,96.2S96.2,75.5,96.2,50S75.5,3.8,50,3.8z M71.2,53.3l-30.8,18  c-0.6,0.4-1.3,0.5-1.9,0.5c-0.6,0-1.3-0.1-1.9-0.5c-1.2-0.6-1.9-1.9-1.9-3.3V32c0-1.4,0.8-2.7,1.9-3.3c1.2-0.6,2.7-0.6,3.8,0  l30.8,18c1.2,0.6,1.9,1.9,1.9,3.3S72.3,52.7,71.2,53.3z"></path></svg>

                                进入应用</router-link>
                            <!--<a class="button gray has-icon" href="https://github.com/mozilan/LvBlog" target="_blank">-->
                            <!--<svg aria-labelledby="simpleicons-github-dark-icon" lang="" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-github-icon" lang="en">GitHub Dark icon</title><path fill="#7F8C8D" d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"></path></svg>-->
                            <!--GITHUB</a>-->
                            <a class="button gray has-icon" href="https://github.com/mozilan/LvBlog" target="_blank">
                                <svg aria-labelledby="simpleicons-github-dark-icon" lang="" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-github-icon" lang="en">GitHub Dark icon</title><path fill="#7F8C8D" d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"></path></svg>
                                Github
                            </a>
                            <a class="button gray has-icon" href="https://gitee.com/bluish_space/lvblog" target="_blank">
                                <img style="height:25px;float: left" src="/images/mayun.png">码云
                            </a>
                        </p>
                    </div>
                    </div>
                </div>
                <div id="special-sponsor">
                    <h3>赞助我们</h3>
                    <a href="#" target="_blank">
                        <img src="https://mozilan.geekadpt.cn/img/custom/donate/AliPayQR.jpg" style="width:200px">
                    </a>
                    <a href="#" target="_blank">
                        <img src="https://mozilan.geekadpt.cn/img/custom/donate/WeChanSQ.jpg" style="width:200px">
                    </a>
                </div>
                <div id="highlights">
                    <div class="inner">
                        <div class="point">
                            <h2>Laravel</h2>
                            <p>Laravel-简洁、优雅的PHP开发框架(PHP Web Framework)。</p>
                        </div>

                        <div class="point">
                            <h2>Vue</h2>
                            <p>Vue (读音 /vjuː/，类似于 view) <br>是一套用于构建用户界面的渐进式框架。</p>
                        </div>

                        <div class="point">
                            <h2>Element-UI</h2>
                            <p>
                                Element,一套为开发者、设计师和产品经理准备的基于Vue 2.0 的桌面端组件库
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <Notification></Notification>
        </div>
        <Register></Register>
        <Login></Login>
    </div>
</template>

<script>
    import Navigation from '../../components/global/NavigationModal';
    import Register from '../../components/global/RegisterModal';
    import Login from '../../components/global/LoginModal';
    import Notification from '../../components/global/Notification';
    export default {
        data() {
            return {
                loader:'',
                minHeight: 0,
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                //console.log(key, keyPath);
            }
        },
        components: {
            Navigation,
            Register,
            Login,
            Notification,
        }
    }
</script>