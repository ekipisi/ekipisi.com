@extends('layouts.app') 
@section('hero', 'is-default is-bold is-fullheight is-feature-wave') 
@section('navbar', 'navbar-dark')

@section('hero-content')
<div class="hero-body">
    <div class="container">
        <div class="is-hidden">{{ Breadcrumbs::render() }}</div>
        <div class="columns">
            <div class="column is-4 is-offset-2 z-index-2">
                <!-- 2 columns -->
                <div class="columns is-vcentered">
                    <div class="column is-12">
                        <div class="flex-card light-bordered  light-raised">
                            <div class="card-body">
                                <h2 class="title is-4 text-bold mb-20">Kredi Kartı Bilgileri</h2>
                                <form id="payment" class="validate">
                                    <div class="columns no-margin-bottom no-padding-bottom">
                                        <div class="column no-margin-bottom no-padding-bottom">
                                            <div class="control">
                                                <input class="input is-medium" placeholder="Web Siteniz" type="text" required>
                                            </div>
                                            <div class="control mt-20">
                                                <input class="input is-medium" name="cardnumber" id="cardnumber" placeholder="Kart Numarası" type="text" required>
                                            </div>
                                            <div class="control mt-20">
                                                <input class="input is-medium" name="name" id="name" placeholder="Kart Sahibi Adı Soyadı" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <div class="control mt-20">
                                                <input class="input is-medium" name="expiry" id="expiry" placeholder="AA/YYYY" maxlength="9" type="text" required>
                                            </div>
                                            <div class="control mt-20">
                                                <input class="input is-medium" name="price" id="price" placeholder="Tutar" type="text" required>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div class="control mt-20">
                                                <input class="input is-medium" name="cvc" id="cvc" placeholder="CVC" maxlength="3" type="text" required>
                                            </div>
                                            <div class="control mt-20">
                                                <div class="select is-medium is-payment-select" id="installment" name="installment" required>
                                                    <select>
                                                            <option value="1">Peşin</option>
                                                            <option value="2">2 Taksit</option>
                                                            <option value="3">3 Taksit</option>
                                                            <option value="4">4 Taksit</option>
                                                            <option value="5">5 Taksit</option>
                                                            <option value="6">6 Taksit</option>
                                                            <option value="7">7 Taksit</option>
                                                            <option value="8">8 Taksit</option>
                                                            <option value="9">9 Taksit</option>
                                                            <option value="10">10 Taksit</option>
                                                            <option value="11">11 Taksit</option>
                                                            <option value="12">12 Taksit</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <div class="control">
                                                <label class="checkbox-wrap is-small">
                                                        <input id="check1" type="checkbox" class="d-checkbox" required>
                                                        <span></span>
                                                        <a href="javascript:void(0);" class="modal-trigger" data-modal="on-bilgilendirme-modal">Ön bilgilendirme</a> formunu kabul ediyorum.
                                                    </label>
                                            </div>
                                            <div class="control">
                                                <label class="checkbox-wrap is-small">
                                                        <input id="check1" type="checkbox" class="d-checkbox" required>
                                                        <span></span>
                                                        <a href="">Mesafeli satış sözleşmesini</a> kabul ediyorum.
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-20">
                                        <button class="button is-fullwidth btn-align no-lh raised is-medium success-btn">
                                                <i class="fa fa-shield"></i> Ödeme Yap</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 2 columns -->
            </div>
            <div class="column is-4 is-offset-1 z-index-2">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <div class="card-wrapper"></div>
                    </div>
                    <div class="column is-12 has-text-centered no-padding">
                        <figure>
                            <img src="{{ asset('images/secure.png') }}" />
                        </figure>
                    </div>
                    <div class="column is-12 has-text-centered is-size-5">
                        <div class="result" style="display: none;">
                            <p class="text-quaternary is-size-6">%18 Kdv + Komisyon Oranı Dahil Toplam Tutar</p>
                            <span class="payment-total is-size-3 text-bold" id="total"></span>
                            <span id="alert" class="color-red is-size-6 text-bold"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div id="on-bilgilendirme-modal" class="modal modal-lg modal-info">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="flex-card simple-shadow">
            <div class="card-body">
                <div class="content">
                    <p>
                        <strong>Satıcı:</strong>
                        <br> Ekipişi Yazılım ve Danışmanlık Hizmetleri - Mustafa Genç
                        <br> Vergi Dairesi : Şirinyer
                        <br> Vergi No : 3920316089 </p>
                    <p>
                        <strong>Alıcı ve Sipariş Tutarı:</strong>
                        <br> “Hizmeti satın almadan önce;
                        <ul>
                            <li>Ekipişi Yazılım ve Danışmanlık Hizmetleri ile ilgili gerekli tüm bilgileri ve iletişim adreslerini,</li>
                            <li>Satın aldığım hizmete ilişkin tüm içeriği, ayrıca tüm vergiler dahil toplam hizmet fiyatını ve
                                varsa tüm ek masraflarını </li>
                            <li>Ödeme, teslimat, ifaya ilişkin bilgileri ve şikayetlere ilişkin sözleşmede düzenlenen çözüm yöntemlerini
                                </li>
                            <li>Uyuşmazlık konusunda başvurularımı Tüketici Mahkemesine veya Tüketici Hakem Heyetine yapabileceğime
                                dair sözleşmesel bilgileri </li>
                            <li>Mesafeli Sözleşmeler Yönetmeliği'nin 15. maddesine istinaden cayma hakkımın bulunmadığını bildiğimi,
                                </li>
                            <li>Hizmet satın alma siparişimi onayladığım takdirde ödeme yükümlülüğü altına gireceğim konusunda
                                açık ve anlaşılır şekilde bilgilendirildiğimi, </li>
                            <li>Bu ön bilgilere vakıf olduğumu ve neticeten Satış Sözleşmesinde düzenlenen tüm hükümleri önceden
                                incelediğimi ve bildiğimi, işbu onay kutusunu işaretlemek suretiyle yazılı olarak kabul,
                                beyan ve taahhüt ederim" </li>
                        </ul> "Ödeme Yap" tuşuna bastığınız zaman, İade ve Değişiklikler hakkındaki şartlar da dahil olmak üzere
                        Ekipişi Yazılım ve Danışmanlık Hizmetleri Satış Sözleşmesi, Gizlilik ve Kullanım Şartları'nı kabul
                        etmiş sayılırsınız. Ekipişi Yazılım ve Danışmanlık Hizmetleri iletişim bilgileri, hizmetlerin temel
                        niteliklikleri, cayma hakkı şartları bu sözleşmelerde detaylı şekilde belirtilmiştir. Hatırlatmak
                        isteriz, eğer taksitle ödemeyi seçtiyseniz vade farkı uygulanacaktır. Satın alma işlemini gerçekleştirdiğiniz
                        anda vade farkını ödemeyi kabul etmiş sayılırsınız. </p>
                </div>
            </div>
        </div>
    </div>
    <button class="modal-close is-large is-hidden" aria-label="close"></button>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/payment.js') }}"></script>
@endsection