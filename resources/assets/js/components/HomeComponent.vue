<template>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-12">
                <div class="card card-default" >
                    <div class="card-header"><p> Search Menu: </p>  <input class="col-sm-3" ype="text" v-model="search" placeholder="Type here to search"/>
                      <!-- Use a button to open the snackbar -->




                      <div class="dropdown" style="float: right;">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Categories
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(0)">All</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(1)">Specials</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(2)">Sandwiches</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(3)">Combos</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(4)">Tramazzini</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(5)">Wraps</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(6)">Burgers & pregos</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(7)">Pies</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(8)"> Vegeterian</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(9)">Salads</button>
                          <button class="dropdown-item" type="button" v-on:click="categorySetter(10)">Beverages</button>
                        </div>
                      </div>


                    </div>

                    <div class="card-body"  style="min-height: 300px;">


                    <div class="card card-default"  v-for="(products, index) in filteredProducts" >


                        <div class="card-body">
                          <h2 style="padding:0px;">{{products.name}}   R{{products.price}}  </h2>

                          <p><span style="font-weight: bold">Description: </span> {{products.description}}</p>

                          <p><span style="font-weight: bold"> Category: </span> {{products.type}}</p>
                          <button type="submit" style="float:right;" v-on:click="add (products), snackbar()" class="btn btn-danger">
                              Add to cart
                          </button>
                        </div>
                        <!-- The actual snackbar -->
                        <div id="snackbar">{{message}}</div>
                    </div>


                    <div class="card card-default"  v-if="filteredProducts.length == 0" >


                        <div class="card-body"  style="min-height: 300px;">
                          <h2 style="padding:0px;">The product you have searched for does not currently exist</h2>

                          <p>Alter your search to ensure that the product that you have requested is currently avaliable </p>

                          <p><span style="font-weight: bold"> </span> </p>

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
              tot: 0,
              search:'',
              category:0,
              matchedProd: []


          };
      },

      created: function(){
        this.$store.dispatch('load');
        this.$store.dispatch('loadCid');
      },


      computed: {

        filteredProducts: function(){

            return this.$store.state.products.filter((product) => {


              if(this.category == 0 && this.search==""){
                return product.type.match("");
              }
              else if(this.category == 1 && this.search=="" ) {
                return product.type.match("special");
              }
              else if(this.category == 2 && this.search=="") {
                return product.type.match("toasted sandwich");
              }
              else if(this.category == 3 && this.search=="") {
                return product.type.match("combo");
              }
              else if(this.category == 4 && this.search=="") {
                return product.type.match("tramazzini");
              }
              else if(this.category == 5 && this.search=="") {
                return product.type.match("wrap");
              }
              else if(this.category == 6 && this.search=="") {
                return product.type.match("burger & prego");
              }
              else if(this.category == 7 && this.search=="") {
                return product.type.match("pie");
              }
              else if(this.category == 8 && this.search=="") {

                return product.type.match("vegeterian");
              }
              else if(this.category == 9 && this.search=="") {
                return product.type.match("salad");
              }
              else if(this.category == 10 && this.search=="") {
                return product.type.match("colddrink");
              } else if (this.search != ""){
                this.category = 0;
                return product.name.match(this.search);
              }


            });




        },



        filteredCart: function(){
            return this.cartdata;
        },



        totCart: function(){
          return this.$store.state.cartdata.length;
        },


        message: function(){

          var message = "";

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
                productType: product.type,
                productQuantity: 1,
                inCart: false
              });
            }

        },

        categorySetter: function(number){
          return this.$store.state.products.filter((product) => {
            if(number == 0){
              this.category = number;
            }
            if(number == 1){
              this.category = number;
            }
            if(number == 2){
              this.category = number;
            }
            if(number == 3){
              this.category = number;
            }
            if(number == 3){
              this.category = number;
            }
            if(number == 4){
              this.category = number;
            }
            if(number == 5){
              this.category = number;
            }
            if(number == 6){
              this.category = number;
            }
            if(number == 7){
              this.category = number;
            }
            if(number == 8){
              this.category = number;
            }
            if(number == 9){
              this.category = number;
            }
            if(number == 10){
              this.category = number;
            }


          });
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
          console.log(this.$userId);
          this.$store.dispatch('load');
          this.$store.dispatch('loadCid');
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
