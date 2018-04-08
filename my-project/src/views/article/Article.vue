<style src="@/styles/main.css"></style>
<template>
<div >
	<router-link to='/edit'>写文章</router-link>
	<p>{{author}}</p>
	<p>{{title}}</p>
	<p>{{updated_time}}</p>
    <vue-markdown  :source='content' v-highlight > </vue-markdown>
</div>
</template>


<script src="@/js/article/article.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

 