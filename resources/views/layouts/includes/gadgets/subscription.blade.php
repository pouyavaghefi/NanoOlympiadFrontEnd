@if (app()->getLocale() === 'ar')
<div class="footer-widget-box list">
    <h4 class="footer-widget-title" style="text-align: right">النشرة الإخبارية</h4>
    <div class="footer-newsletter" style="text-align: right">
        <p>اشترك في نشرتنا الإخبارية للحصول على آخر التحديثات والأخبار</p>
        <div class="subscribe-form">
            <form action="{{ route('frt.new.sub') }}" method="POST">
                @csrf
                <button class="theme-btn" type="submit">
                    اشترك الآن <i class="far fa-paper-plane"></i>
                </button>
                <input type="email" class="form-control" placeholder="بريدك الإلكتروني" name="email" style="text-align: right;">
            </form>
        </div>
    </div>
</div>
@else
<div class="footer-widget-box list">
    <h4 class="footer-widget-title">Newsletter</h4>
    <div class="footer-newsletter">
        <p>Subscribe Our Newsletter To Get Latest Update And News</p>
        <div class="subscribe-form">
            <form action="{{ route('frt.new.sub') }}" method="POST">
                @csrf

                <input type="email" class="form-control" placeholder="Your Email" name="email">
                <button class="theme-btn" type="submit">
                    Subscribe Now <i class="far fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endif
