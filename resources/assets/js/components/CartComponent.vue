<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Cart</div>

                    <div class="card-body">
                      <table class="table table-striped">
                        <thead>
                          <tr>

                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>

                            <td>Cheese Burger</td>
                            <td>R 28</td>
                            <td>4</td>
                          </tr>
                          <tr>

                            <td>Ham cheese and tomato</td>
                            <td>R 20</td>
                            <td>2</td>
                          </tr>
                          <tr>
                            <td>Monster</td>
                            <td>R 16</td>
                            <td>3</td>
                          </tr>
                        </tbody>
                      </table>

                      <button style="position: relative; left:0%;"type="submit" class="btn btn-danger">
                          Check Out
                      </button>
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
