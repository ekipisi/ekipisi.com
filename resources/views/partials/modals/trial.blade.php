<div id="ucretsiz-denemeye-basla-modal" class="modal modal-info">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="flex-card simple-shadow">
            <div class="card-body">
                <h2 class="title is-4 text-bold mb-40 has-text-centered">Demo Talep Formu</h2>
                <p class="is-text-5 has-text-centered">Benzersiz ve esnek e-ticaret altyapımız ile siz de başarıyı hızlıca yakalayabilirsiniz.</p>
                <form class="validation" method="POST" action="{{ route('demo') }}">
                    {{ csrf_field() }}
                    <div class="columns mt-20">
                        <div class="column">
                            <div class="control">
                                <label>Ad*</label>
                                <input class="input is-medium mt-5" name="firstname" type="text" required>
                            </div>
                            <div class="control mt-10">
                                <label>Telefon*</label>
                                <input class="input is-medium mt-5" name="phone" type="text" required>
                            </div>
                        </div>
                        <div class="column">
                            <div class="control">
                                <label>Soyad*</label>
                                <input class="input is-medium mt-5" name="lastname" type="text" required>
                            </div>
                            <div class="control mt-10">
                                <label>E-Posta*</label>
                                <input class="input is-medium mt-5 required email" name="email" type="email">
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="control">
                                <label>Mesajınız</label>
                                <textarea class="textarea is-grow" name="message" rows="5" placeholder="İletmek istediğiniz bir konu varsa giriniz."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="control"><div class="columns">
                            <label class="checkbox-wrap is-small">
                                <input id="check1" type="checkbox" name="newsletter" value="1" class="d-checkbox">
                                <span></span>
                                Kampanyalardan (Sms, E-posta) haberdar olmak istiyorum.
                            </label>
                        </div>
                    </div>
                    </div>
                    <div class="mt-10 has-text-right">
                        <button type="submit" class="button btn-align no-lh raised accent-btn">Demoyu Bilgilerini Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="modal-close is-large is-hidden" aria-label="close"></button>
</div>