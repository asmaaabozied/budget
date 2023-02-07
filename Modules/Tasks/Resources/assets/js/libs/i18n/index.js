import { createI18n } from "vue-i18n";
// import messages from '@intlify/unplugin-vue-i18n/messages'

// import locals dynamically
// function loadLocaleMessages() {
//     const locales = require.context('./locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
//     const messages = {}
//     locales.keys().forEach(key => {
//         const matched = key.match(/([A-Za-z0-9-_]+)\./i)
//         if (matched && matched.length > 1) {
//             const locale = matched[1]
//             messages[locale] = locales(key)
//         }
//     })
//     return messages
// }

import en from './locales/en.json';
import ar from './locales/ar.json';

const i18n = createI18n({
    legacy: false,
    globalInjection: true,
    locale: webLocale || 'ar', // this ivar in blade fil
    fallbackLocale: "ar",
    availableLocales: ["en", "ar"],
    // messages: loadLocaleMessages, // if dynammically
    messages: {
        en,
        ar
    },
    // messages
});

export default i18n