<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Employee Dashboard</div>

                    <div class="card-body" style="min-height: 300px;">

                        <div class="card card-default" v-for="(order, index) in orders" >
                            <div class="card-body">
                              <h2 style="padding:0px;">Order: {{number}} </h2>

                              <p><span style="font-weight: bold">User: </span> {{username}}</p>

                              <p><span style="font-weight: bold"> Products: </span> <span> placeholder </span></p>

                              <button type="submit" style="float:right;" v-on:click="" class="btn btn-danger">
                                  Decline
                              </button>

                              <button type="submit" style="float:right;" v-on:click="" class="btn btn-primary">
                                  Accept
                              </button>
                            </div>

                        </div>

                    </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
      computed: {
          orders(){
            return this.Orders
          },
          username(){
            return this.user;
          },

          number(){
             return Math.floor(Math.random() * (25 - 1 + 1)) + 1;
          }
      },
      data() {
        return {
          Orders: [],
          user: ""
        }
      },
      methods: {
        send(){

        }

      },

      mounted(){

        Echo.private('order').listen('OrderEvent', (e) => {
            this.orders.push(e.order[0]);
            this.user = e.user.name;
            console.log(e.order[0]);
        });
      }
    }
</script>
