window.addEventListener('load', () => {
    
    const script = document.createElement('script');
    script.src = 'https://redirectrussia.org/v1.js';
    script.async = 'true';
    script.integrity = 'sha384-K4/XEYup4kNv/qt2ucIwIH2wLT9I+z3s17CHQNMBB2/E8/Kw2VYsXQKB/7kylubA';
    script.crossOrigin = 'anonymous';

    if (
        typeof swiuOptions.redirectOption !== 'undefined' &&
        swiuOptions.redirectOption !== null &&
        swiuOptions.redirectOption === 'custom' &&
        typeof swiuOptions.redirectUrl !== 'undefined' &&
        swiuOptions.redirectUrl !== null &&
        swiuOptions.redirectUrl.length > 0
    ) {
        script.setAttribute('data-redirect-url', swiuOptions.redirectUrl);
    }

    if (
        typeof swiuOptions.showDomainOption !== 'undefined' &&
        swiuOptions.showDomainOption !== null &&
        swiuOptions.showDomainOption === 'yes'
    ) {
        script.setAttribute('data-hide-domain', 'hide');
    }

    document.querySelector('body').appendChild(script);
});