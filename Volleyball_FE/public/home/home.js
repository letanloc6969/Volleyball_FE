// function addToCart(event){
//     event.preventDefault();
//     let urlCart = $(this).data('url');
//     $.ajax({
//        type: "GET",
//         url: urlCart,
//         dataType: 'json',
//         success: function (data){
//             if(data.code === 200){
//                 alert('Thêm sản phẩm thành công');
//             }
//         },
//         error: function (){
//
//         }
//     });
// }
//
// $(function (){
//     $('.add-to-cart').on('click', addToCart);
// });
//
// ///////////////////
// function cartUpdate(event)
// {
//     event.preventDefault();
//     let urlUpdateCart = $('.update_cart_url').data('url');
//     let id = $(this).data('id');
//     let quantity = $(this).parents('tr').find('input.quantity').val();
//     $.ajax({
//         type: "GET",
//         url: urlUpdateCart,
//         data: {id: id, quantity: quantity},
//         success: function (data){
//             if (data.code === 200) {
//                 $('.card_wrapper').html(data.cart_component);
//                 alert('Cập nhật giỏ hàng thành công');
//             }
//         },
//         error: function ()
//         {
//
//         }
//     });
// }
//
// function cartDelete(event)
// {
//     event.preventDefault();
//     let urlDelete = $('.cart_component').data('url');
//     let id = $(this).data('id');
//     $.ajax({
//         type: "GET",
//         url: urlDelete,
//         data: {id: id},
//         success: function (data){
//             if (data.code === 200) {
//                 $('.card_wrapper').html(data.cart_component);
//                 alert('Cập nhật giỏ hàng thành công');
//             }
//         },
//         error: function ()
//         {
//
//         }
//     });
// }
//
// $(function (){
//     $(document).on('click','.cart_update', cartUpdate);
//     $(document).on('click','.cart_delete', cartDelete);
// })

