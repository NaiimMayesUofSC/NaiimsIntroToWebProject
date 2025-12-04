// script.js
document.addEventListener("DOMContentLoaded", function () {
  function openPopup(url, title, w, h) {
    const left = window.screenLeft + (window.innerWidth - w) / 2;
    const top  = window.screenTop  + (window.innerHeight - h) / 2;
    const features = `width=${w},height=${h},left=${left},top=${top},toolbar=0,status=0`;
    const newWindow = window.open(url, title, features);
    if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {
      // Popup blocked then fallback to same tab navigation
      window.location.href = url;
    } else {
      newWindow.focus();
    }
  }

  function tryNativeShare(data) {
    if (navigator.share) {
      return navigator.share(data).then(() => true).catch(() => false);
    }
    return Promise.resolve(false);
  }

  function getShareInfo(button) {
    let url  = button.getAttribute('data-url')  || '';
    let text = button.getAttribute('data-text') || '';

    if (!url) {
      const ogUrl = document.querySelector('meta[property="og:url"]');
      if (ogUrl && ogUrl.content) url = ogUrl.content;
      else {
        const canonical = document.querySelector('link[rel="canonical"]');
        if (canonical && canonical.href) url = canonical.href;
      }
      if (!url) url = location.href;
    }

    if (!text) {
      const ogTitle = document.querySelector('meta[property="og:title"]');
      text = (ogTitle && ogTitle.content) ? ogTitle.content : document.title || '';
    }

    return { url, text };
  }

  function shareOnFacebook(urlToShare) {
    const shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(urlToShare);
    openPopup(shareUrl, 'Share on Facebook', 700, 500);
  }

  function shareOnTwitter(urlToShare, textToShare) {
    const twitterUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(urlToShare)
                       + (textToShare ? '&text=' + encodeURIComponent(textToShare) : '');
    openPopup(twitterUrl, 'Share on Twitter', 700, 420);
  }

  const fbBtn = document.getElementById('share-facebook');
  const twBtn = document.getElementById('share-twitter');

  if (fbBtn) {
    fbBtn.addEventListener('click', async function () {
      const { url, text } = getShareInfo(fbBtn);
      const usedNative = await tryNativeShare({ title: text, url: url });
      if (!usedNative) shareOnFacebook(url);
    });
  }

  if (twBtn) {
    twBtn.addEventListener('click', async function () {
      const { url, text } = getShareInfo(twBtn);
      const usedNative = await tryNativeShare({ title: text, url: url });
      if (!usedNative) shareOnTwitter(url, text);
    });
  }
});
