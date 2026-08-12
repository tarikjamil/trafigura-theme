<script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_template_directory_uri(); ?>/assets/js/trafigura-staging.js?v=1786536781" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/CustomEase.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/code/script.js?v=1786541600"></script>
<script>
document.getElementById('facebook-share-link').addEventListener('click', function() {
const pageUrl = encodeURIComponent(window.location.href);
const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
window.open(shareUrl, '_blank');
});
</script>
<script>
document.getElementById('twitter-share-link').addEventListener('click', function() {
const pageUrl = encodeURIComponent(window.location.href);
const tweetText = encodeURIComponent('Check this out!');
const shareUrl = `https://twitter.com/intent/tweet?text=${tweetText}&url=${pageUrl}`;
window.open(shareUrl, '_blank');
});
</script>
<script>
document.getElementById('linkedin-share-link').addEventListener('click', function() {
const pageUrl = encodeURIComponent(window.location.href);
const shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${pageUrl}`;
window.open(shareUrl, '_blank');
});
</script>