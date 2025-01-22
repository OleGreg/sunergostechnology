function registerFormEvent() {
  const form = document.querySelector('.forminator-custom-form');

  if(form) {
    form.addEventListener('submit', () => {
      alert('submitted');
      gtag('event', 'form_submission', {
        event_category: 'engagement',
        event_label: window.location.href,
        referrer: document.referrer
      });
    });
  }
}

export { registerFormEvent }