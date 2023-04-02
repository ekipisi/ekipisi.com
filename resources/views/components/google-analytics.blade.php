<script async src="https://www.googletagmanager.com/gtag/js?id=UA-60441501-32"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  @auth
  gtag('set', {'user_id': '{{ Auth::user()->id }}'});
  @endauth
  
  gtag('config', '{{ env("ANALYTICS_TRACKING_ID") }}');
</script>