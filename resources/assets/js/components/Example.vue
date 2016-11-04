<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component! <br/>
                        This is local msg  {{local_msg}}  <input v-model="local_msg"><br/>
                        This is parrant msg  {{parrant_msg}} <input v-model="parrant_msg"> <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
      props: ['local_msg', 'parrant_msg']
  };
</script>
