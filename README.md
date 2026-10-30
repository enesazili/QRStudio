# QR Studio

Metin, URL ve Wi-Fi bağlantısı için QR kodu üreten tek dosyalık tarayıcı aracı. Kodu PNG
veya SVG olarak indirir; üretim tamamen yerel `qrcode-generator` 1.4.4 kütüphanesiyle
yapılır. Girilen metin ve Wi-Fi parolası hiçbir yere gönderilmez.

- Dosya: `qrstudio.php` (tek dosya, ~112 KB; QR kütüphanesi gömülü)
- Yardımcı dosya: `qrcode-generator-1.4.4.LICENSE.txt` (MIT lisans metni, **korunmalıdır**)
- Çalıştığı yer: tarayıcı (istemci tarafı)
- Sunucu tarafı kod: yok

## Amaç

Bir bağlantı, kısa metin veya Wi-Fi ağı için paylaşılabilir bir QR kodu üretmek; bunu
kayıpsız vektör (SVG) ya da raster (PNG) olarak indirmek. Harici QR servisi kullanmamak
gizlilik açısından tercih nedenidir.

## Özellikler

- Tür seçimi: **Metin**, **URL**, **Wi-Fi bağlantısı**.
- URL türünde yalnızca `http://` ve `https://` adresleri kabul edilir.
- Wi-Fi alanları: SSID, güvenlik (WPA/WPA2/WPA3, WEP, parolasız), parola, gizli ağ.
- Boyut (128–1024 px), modül kenar boşluğu (0–16 modül) ve hata düzeltme düzeyi
  (L / M / Q / H).
- Ön plan ve arka plan renkleri; yalnızca `#rrggbb` biçimi kabul edilir.
- Kontrast oranı hesabı ve düşük kontrast uyarısı.
- Canlı Canvas önizleme; PNG indirme ve SVG indirme.
- "Girdileri temizle" ile formu sıfırlama.

## Gereksinimler

- Güncel Chrome, Edge, Firefox veya Safari.
- `Canvas` (PNG), `Blob`, `URL.createObjectURL`, `TextEncoder`.
- JavaScript açık olmalıdır.
- Ağ bağlantısı gerekmez: kütüphane dosyaya gömülüdür, CDN çağrısı yoktur.

## Çalıştırma

```powershell
python -m http.server 8000
# veya
php -S 127.0.0.1:8000
```

`http://127.0.0.1:8000/qrstudio.php` adresini açın. `file://` üzerinden de çalışır.
Dağıtımda `.php` dosyasının yanında `qrcode-generator-1.4.4.LICENSE.txt` bulunmalıdır.

## Kullanım

1. Türü seçin (Metin / URL / Wi-Fi).
2. İlgili alanları doldurun; önizleme yazarken güncellenir.
3. Boyut, kenar, hata düzeltme ve renkleri ayarlayın. Kontrast uyarısına dikkat edin.
4. "PNG indir" veya "SVG indir" ile dosyayı alın.
5. Telefonla taranabilirliği gerçek bir cihazda doğrulayın.

## Teknik ayrıntılar

- QR matrisi gömülü `qrcode-generator` 1.4.4 (MIT) sürümüyle üretilir; sürüm numarası
  sabittir ve otomatik güncellenmez.
- SVG çıktısı yalnızca modül koordinatlarından ve doğrulanmış `#rrggbb` renklerinden
  oluşturulur. Kullanıcı metni SVG kaynağına **yazılmaz**; `<title>` alanı sabit metindir.
- PNG çıktısı Canvas üzerinde çizilip `toBlob` ile üretilir; indirme yerel blob adresiyle
  yapılır.
- Renk doğrulaması ve kontrast hesabı (`sanitizeColor`, `contrastRatio`,
  `relativeLuminance`) saf fonksiyonlardır.
- Wi-Fi yükü (`WIFI:T:...;S:...;P:...;H:...;;`) üretilirken `\`, `;`, `,`, `:`, `"`
  karakterleri kaçırılır.
- Kullanıcı girdisi hiçbir zaman `innerHTML` ile DOM'a yazılmaz.

## Sınırlar ve güvenlik

| Sınır | Değer |
| --- | --- |
| Metin uzunluğu | 2000 karakter |
| Görsel boyutu | 128–1024 px |
| Modül kenar boşluğu | 0–16 modül |

- Sınır aşılırsa üretim yapılmaz ve neden bildirilir.
- Ağ isteği yoktur; QR içeriği hiçbir sunucuya veya üçüncü tarafa gönderilmez.
- SVG kaynağında kullanıcı metni, `<script>` veya `on*` özniteliği bulunmaz.
- Kontrast uyarısı bilgilendirme amaçlıdır; düşük kontrastlı kod yine de üretilebilir,
  bu durumda taranabilirlik garanti edilmez.
- "QR Code" kelimesi DENSO WAVE INCORPORATED'ın tescilli markasıdır.

## Lisans

- Gömülü `qrcode-generator` 1.4.4 kütüphanesi **MIT** lisanslıdır:
  Copyright (c) 2009 Kazuhiko Arase, <https://github.com/kazuhikoarase/qrcode-generator>.
  Tam metin `qrcode-generator-1.4.4.LICENSE.txt` dosyasındadır ve dosyadaki lisans
  başlığı korunmuştur. Bu bildirim kaldırılmamalıdır.

## Test edilenler

2026-10-28, Edge/Chromium 156 ve PHP 8.3.36 ile:

- Dosya portfolyo dışındaki geçici bir klasörden servis edildi: `HTTP 200`, tek `<h1>`,
  harici kaynak yok, konsol hatası yok.
- `normalizeOptions` boyut/kenar/renk değerlerini doğruladı.
- `buildMatrix` 21 modüllü (sürüm 1) matris üretti.
- SVG çıktısı `<svg` ile başladı; kullanıcı metni (`example.com`), `<script>` ve `on*`
  özniteliği içermedi.
- `sanitizeColor('#FF0000')` normalleştirdi; `sanitizeColor('red')` reddedildi.
- Siyah/beyaz kontrast oranı 21:1 olarak hesaplandı.
- Arayüz üzerinden `https://example.com/test` yazıldığında Canvas 231×231 üretildi ve
  PNG indirme düğmesi etkinleşti.
- 1440 px ve 390 px genişlikte yatay taşma yok.

## Test edilmeyenler ve bilinen sınırlar

- Firefox ve Safari'de gerçek tarayıcı testi yapılmadı.
- Gerçek mobil cihaz ve ekran okuyucu testi yapılmadı.
- **Üretilen kodun taranabilirliği otomatik test edilmedi**; yalnızca renk kontrastı
  hesaplanır. Fiziksel baskı ve kamera testi yapılmadı.
- 2000 karakterlik üst sınırda matris yoğunluğu ve baski kalitesi değerlendirilmedi.
- Wi-Fi QR kodunun iOS/Android tarafından okunması cihazda denenmedi.
- SVG çıktısı bazı eski yazıcı/vektör yazılımlarında farklı yorumlanabilir.
