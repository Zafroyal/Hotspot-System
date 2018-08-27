<template>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-12">
                <div class="card card-default" >
                    <div class="card-header">Menu
                      <!-- Use a button to open the snackbar -->




                      <div class="dropdown" style="float: right;">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Categories
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <button class="dropdown-item" type="button">All</button>
                          <button class="dropdown-item" type="button">Specials</button>
                          <button class="dropdown-item" type="button">Sandwiches</button>
                          <button class="dropdown-item" type="button">Combos</button>
                          <button class="dropdown-item" type="button">Tramazzini</button>
                          <button class="dropdown-item" type="button">Wraps</button>
                          <button class="dropdown-item" type="button">Burgers & pregos</button>
                          <button class="dropdown-item" type="button">Pies</button>
                          <button class="dropdown-item" type="button"> Vegeterian</button>
                          <button class="dropdown-item" type="button">Salads</button>
                          <button class="dropdown-item" type="button">Wraps</button>
                          <button class="dropdown-item" type="button">Beverages</button>
                        </div>
                      </div>


                    </div>

                    <div class="card-body"  style="min-height: 300px;">
                    <div class="card card-default"  v-for="(products, index) in filteredProducts" >


                        <div class="card-body">
                          <h2 style="padding:0px;">{{products.name}}   R{{products.price}}  </h2>

                          <p>{{products.description}}</p>
                          <button type="submit" v-on:click="add (products), snackbar(), isExist(products)" class="btn btn-danger">
                              Add to cart
                          </button>
                        </div>
                        <!-- The actual snackbar -->
                        <div id="snackbar">{{message}}</div>
                    </div>



                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
      data:function() {
          return {
              inCart: false,
              tot: 0
          };
      },

      created: function(){
        this.$store.dispatch('load');
      },

      computed: {

        filteredProducts: function(){
            return this.$store.state.products;
        },

        filteredCart: function(){
            return this.cartdata;
        },

        totCart: function(){
          return this.$store.state.cartdata.length;
        },

        message: function(){

          var message = "";
          console.log(this.tot);
          if(this.tot < 100 && this.inCart == false )
           message = "Item has been added to cart";
          else if(this.inCart == true){
           message = "Item is already in cart";
          }

          else {
             message = "Cart full make sure that your total is less than R100";
          }



          return message;
        }

      },


      methods: {
        add:function(product){

            this.tot = 0;

            for(var i = 0; i < this.$store.state.cartdata.length; i++){
              console.log(this.$store.state.cartdata.productQuantity);

              if( this.$store.state.cartdata[i].id == product.id){
                 this.inCart = true;
                 break;
              }
              else {
                 this.inCart = false;
              }
            }

            this.$store.state.cartdata.forEach(product => this.tot += product.price);





            if( this.tot < 100 && this.inCart == false){
              this.$store.commit({
                type:'addProduct',
                productID: product.id,
                productName: product.name,
                productPrice: product.price,
                productQuantity: 1,
                inCart: false
              });
            }

        },

        isExist: function(product){

        },

        snackbar: function() {
          // Get the snackbar DIV
          var x = document.getElementById("snackbar");



          // Add the "show" class to DIV
          x.className = "show";

          // After 3 seconds, remove the show class from DIV
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1500);




        }


      },

      mounted(){

      }

}
</script>

<style>
  /* The snackbar - position it at the bottom and in the middle of the screen */
  #snackbar {
      visibility: hidden; /* Hidden by default. Visible on click */
      min-width: 250px; /* Set a default minimum width */
      margin-left: -125px; /* Divide value of min-width by 2 */
      background-color: #333; /* Black background color */
      color: #fff; /* White text color */
      text-align: center; /* Centered text */
      border-radius: 2px; /* Rounded borders */
      padding: 16px; /* Padding */
      position: fixed; /* Sit on top of the screen */
      z-index: 1; /* Add a z-index if needed */
      left: 50%; /* Center the snackbar */
      bottom: 30px; /* 30px from the bottom */
  }

  /* Show the snackbar when clicking on a button (class added with JavaScript) */
  #snackbar.show {
      visibility: visible; /* Show the snackbar */

  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }

  /* Animations to fade the snackbar in and out */
  @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
  }

  @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
  }

  @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
  }

  @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
  }
</style>
