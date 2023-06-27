<template>
    <ul class="chat list-unstyled">
        <li class="left clearfix" v-for="message in messages" :key="message.id"
            :style="(user === message.user.id) ? {float: 'right', 'align-self': 'flex-end'} :  {float: 'left', 'align-self': 'flex-start'}">

            <div class="header"
                 :style="user === message.user.id ? {background : '#00b0ff',color:'#fff'} : { background: '#eceff1', color: '#1a1a1a'}">
                <h5>{{ message.message }}</h5>
                <small>{{ message.user.name }}</small>
            </div>
        </li>
    </ul>
</template>
<script>
export default {
    props: ["messages", "user"],

};
</script>
<style>

.chat {
    position: relative;
    overflow: hidden;
    padding: 0 35px 92px;
    justify-content: flex-end;
    flex-direction: column;
}

.chat li {
    clear: both;
}

.chat .header {
    font-size: 16px;
    position: relative;
    display: inline-block;
    clear: both;
    margin-bottom: 8px;
    padding: 13px 14px;
    vertical-align: top;
    border-radius: 5px;
}
</style>
