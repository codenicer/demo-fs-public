
<!-- {{$popup = \App\Popup::where('is_enabled', '=', 1)->first()}} -->
<div
    onclick="hidePopUp()"
    id='pop-up-modal'
    class='position-fixed d-none align-items-center justify-content-center pop-up-modal'>
    <div
        class='d-flex flex-column'
        id='pop-up-content-wrap'>
        <div 
            class='align-self-end mb-2'
            onclick='hidePopUp()'>
            <i class='la la-close strong'></i>
        </div>
        <div class='bg-white p-3'>
           <a href="#">
               <img src="https://scontent.fmnl4-4.fna.fbcdn.net/v/t1.0-9/p960x960/80039006_993481361024978_940809287653916672_o.jpg?_nc_cat=100&_nc_ohc=eyitPnDoAMEAQlpgOtwlHXY6UX2sIsGUgV0Ovn-llq1Z_KcHiXdf3_jnQ&_nc_ht=scontent.fmnl4-4.fna&oh=db337b6bd8204f264b9742fd3b0670a8&oe=5EB3E794" height='200px' class="mx-2">
           </a>
        </div>
    </div>
</div>