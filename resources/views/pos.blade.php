<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Point Of Sale</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">MMS Web POS</h1>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" placeholder="Customer Number"  class="form-control" id="CnName" value="{{ucwords('John')}}">
                </div>
                <div class="col">
                    <input type="text" placeholder="Invoice Number" class="form-control" id="InvoiceValue" value="{{strtoupper(uniqid())}}">
                </div>
                <div class="col">
                    <input type="date" placeholder="Date" class="form-control" value="{{date('Y-m-d')}}">
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="border rounded p-2">
                <div class="row" id="products" style="height:600px!important;">
                    @foreach($items as $item)
                        <div class="col-6 col-md-4  ">
                            <div class="card product-card mb-3" data-id="{{$item->id}}">
                                <div class="card-body">
                                    <img class="product-img" src="{{asset('storage/item-photo/'.$item->photo)}}" alt="">
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="small text-truncate mb-0">{{$item->name}}</p>
                                        <p class="small text-black-50 mb-0">{{$item->price}}MMK</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-4 ">
            <div class="border rounded p-2" id="voucher">
                <h4 class="d-flex justify-content-between align-items-center mb-2">
                    <span class="" style="color:#950101">Order List</span>
                    <div class="">
                        <h4 class="font-weight-bold mb-0" >
                            Total:
                            <span id="total">O </span>MMK
                        </h4>
                    </div>
                </h4>
                <ul class="list-group" id="voucherList">

                </ul>
                <button class="btn btn-info w-100 mt-3" id="order" style="background: #764AF1!important;" >Check Out</button>


            </div>
        </div>
    </div>
</div>


{{--Modal--}}
<div class="modal fade" id="productDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailLabel">Add To Voucher</h5>
            </div>
            <div class="modal-body">
                <form class="text-center" id="modalform"  >
                    <p id="productModalTitle"></p>
                    <img src="" height="150" id="productModalImg" alt="">
                    <p class="text-black-50" >
                        <span id="productModalPrice"></span>MMK
                    </p>

                    <div class="input-group mb-3 w-50 mx-auto">
                        <button class="btn btn-outline-secondary" type="button"  id="quantityMinus">
                            <i class="fa-solid fa-minus fa-fw"></i>
                        </button>
                        <input type="number" class="form-control text-end" price="" min="1" value="1" id="productModalQuantity" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <button class="btn btn-outline-secondary" type="button" id="quantityPlus">
                            <i class="fa-solid fa-plus fa-fw"></i>
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" id="addToVoucher">Add To Voucher</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var productLists= @json($items);
    console.log(productLists);
    let productDetailModal = document.getElementById("productDetail");
    let modal = new bootstrap.Modal(productDetailModal);
    let productModalTitle = document.getElementById("productModalTitle");
    let productModalImg = document.getElementById("productModalImg");
    let productModalPrice = document.getElementById("productModalPrice");
    let productModalQuantity = document.getElementById("productModalQuantity");
    let quantityPlus = document.getElementById("quantityPlus");
    let quantityMinus = document.getElementById("quantityMinus");
    let allProductCard = document.querySelectorAll(".product-card");
    let addToVoucher = document.getElementById("addToVoucher");
    let voucherList = document.getElementById("voucherList");
    let modalId = document.getElementById('modalform');
    let checkout=document.getElementById('order');
    let storeVoucher=[];

    $(function ($) {

        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token.content
                }
            });
        } else {
            console.error('Token Not Found');
        }
    })

    allProductCard.forEach(function (el){
        el.addEventListener("click",function (){
            let currentId = el.getAttribute("data-id");
            let currentDetail = productLists.find(productList => productList.id == currentId);
            {{--console.log( {{public_path()}});--}}
                productModalTitle.innerText = currentDetail.name
            productModalImg.src ="http://127.0.0.1:8000/storage/item-photo/"+currentDetail.photo
            modalId.setAttribute("data-id",currentDetail.id)
            productModalPrice.innerText = currentDetail.price
            productModalQuantity.setAttribute("price",currentDetail.price)
            modal.show()
        });
    });
    function voucherListCreate(title,price,quantity,cost){
        let li = document.createElement("li");
        li.classList.add("list-group-item","d-flex","justify-content-between");
        li.innerHTML = `
        <div class="w-75">
            <h6 class="my-0 text-truncate">${title}</h6>
            <small class="text-muted">
                Price : ${price} x ${quantity}
            </small>
            <i class=" fas fa-trash-alt btn btn-outline-danger btn-sm cart-del-btn" style="margin-left: 35px!important;">del</i>
        </div>
        <div class="text-muted w-25 voncher-cost text-end price">${cost} </div>


    `;

        return li;
    }
    function calcCost(){
        currentPrice = Number(productModalQuantity.getAttribute("price"));
        productModalPrice.innerText = productModalQuantity.valueAsNumber * currentPrice
    }

    quantityPlus.addEventListener('click',function (){
        productModalQuantity.valueAsNumber += 0
        calcCost()
    });
    quantityPlus.addEventListener('click',function (){
        productModalQuantity.valueAsNumber += 1
        calcCost()
    });

    quantityMinus.addEventListener('click',function (){
        if(productModalQuantity.valueAsNumber > 1){
            productModalQuantity.valueAsNumber -= 1
            calcCost()
        }
    });

    addToVoucher.addEventListener("click",function (){
        let v={
            item_id:modalId.getAttribute('data-id') ,
            title:productModalTitle.innerText,
            quantity:productModalQuantity.valueAsNumber,
            price:productModalPrice.innerText,

        }
        storeVoucher.push(v);
        console.log(storeVoucher);
        voucherList.append(voucherListCreate(
            productModalTitle.innerText,
            productModalQuantity.getAttribute("price"),
            productModalQuantity.valueAsNumber,
            productModalPrice.innerText
        ));
        modal.hide();
        totalPrice();
        productModalQuantity.valueAsNumber = 1
    });
    function totalPrice()
    {
        $("#total").html($(".price").toArray().map(el=>el.innerHTML).reduce((x,y)=>Number(x)+Number(y)));
    };
    $("#voucherList").delegate(".cart-del-btn","click",function () {
        $(this).parentsUntil("#voucherList").remove();
        totalPrice();
    });

    $('#order').on('click',function(){
        $.ajax({
            url:'/order',
            method:'POST',
            data:{
                customer_name : document.getElementById("CnName").value,
                invoice_number : document.getElementById("InvoiceValue").value,
                voucher_list : storeVoucher,

            },
            success:function(res){
                if(res.status == 'success'){
                    storeVoucher = [];
                    voucherList.innerHTML = null;
                    $("#total").html('O');
                    alert(res.message)
                }
            }
        });
    })

</script>
</body>
</html>
