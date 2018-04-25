$('.navbar_close').click(function(){
    $('.sidebar-wrapper').css('display','none')
    $('.main-panel').css('width','100%')
    $(this).css('display','none')
    $('.logo').css('display', 'none')
    $('.navbar_open').css('display','inline-block')
})  
$('.navbar_open').click(function(){
    $('.sidebar-wrapper').css('display','block')
    $('.main-panel').css('width','calc(100% - 260px)')
    $(this).css('display','none')
    $('.logo').css('display', 'block')
    $('.navbar_close').css('display','inline-block')
})  

