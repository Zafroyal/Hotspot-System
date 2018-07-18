<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Orders</div>

                    <div class="card-body">
                      <div class="card card-default">


                          <div class="card-body">
                            <h3 style="padding:0px;">Wors Roll R24</h3>
                            <p>The wors is normally added to the cooking hamburger patty shortly before serving, which allows the sauce to melt.</p>
                            <div class="alert alert-warning">
                              <strong>Pending...</strong> Your order is yet to be accepted</a>.
                            </div>
                          </div>
                      </div>
                      <div class="card card-default">


                          <div class="card-body">
                            <h3 style="padding:0px;">Cheese Burger R28</h3>
                            <p>The cheese is normally added to the cooking hamburger patty shortly before serving, which allows the cheese to melt.</p>

                            <div class="alert alert-success">
                            <strong>Ready for Collection!</strong> Dont forget to collect within an hour or your order will be removed.
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
