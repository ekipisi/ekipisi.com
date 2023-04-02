<div id="main-hero" class="hero-body">
    <div class="container">
        <div class="columns is-vcentered pt-40">
            <div class="column"></div>
            <div class="column is-9">
                <div class="help-header">
                    <img src="{{ asset('images/illustrations/support.svg') }}" alt="">
                    <h1 class="title is-4">Bilgi Bankası</h1>
                </div>
                <div class="help-subheader">
                    <h2 class="title is-5">Müşterilerimiz tarafından sıkça sorulan soruların çözümlerini görerek sorunuzun cevabını bulun.</h2>
                </div>
                <div class="help-search-wrapper">
                    <form action="{{ route('user.faq.search') }}" method="GET" class="validate">
                            <input type="text" name="query" placeholder="sık sorulan sorular arasında arama yapın..." value="{{ (isset($query) ? $query:"") }}" autocomplete="off">
                        <i class="sl sl-icon-magnifier"></i>
                    </form>
                </div>
            </div>
            <div class="column"></div>
        </div>
    </div>
</div>