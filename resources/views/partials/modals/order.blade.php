<div id="siparis-modal" class="modal modal-info">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="flex-card simple-shadow">
            <div class="card-body">
                <h2 class="title is-4 text-bold mb-40 has-text-centered">Sipariş Ver</h2>
                <p class="is-text-5 has-text-centered">Formu doldurup, Devam et butonuna tıklayarak kayıt işlemine geçiş yapabilirsiniz.</p>
                <form class="validation" method="POST" action="{{ route('order') }}">
                    {{ csrf_field() }}
                    <div class="columns mt-20">
                        <div class="column is-8">
                            <div class="control">
                                <label>Site Adresiniz <small>(Eğer Belirlemediyseniz Boş Bırakabilirsiniz)</small></label>
                                <input class="input is-medium mt-5" name="domain" type="text">
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="control">
                                <label>Paket Tercihiniz</label>
                                <div class="select is-medium is-fullwidth" style="margin-top:4px;">
                                    <select name="pack" id="pack">
                                        <option value="1">Lite Paket</option>
                                        <option value="2">Pro Paket</option>
                                        <option value="3">Extended Paket</option>
                                        <option value="4">Platinum Paket</option>
                                    </select>
                                </div>
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
                    <div class="mt-10 has-text-right">
                        <button type="submit" class="button btn-align no-lh raised accent-btn">Devam Et</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="modal-close is-large is-hidden" aria-label="close"></button>
</div>