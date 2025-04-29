const languages = ["tr", "en", "uz", "ar"];

const defaultLanguage = languages[0];

const locales = [
  { id: languages[0], name: "Türkçe", flag: "/flags/tr.svg" },
  { id: languages[1], name: "English", flag: "/flags/us.svg" },
  { id: languages[3], name: "Oʻzbek", flag: "/flags/uz.svg" },
  { id: languages[4], name: "العربية", flag: "/flags/sa.svg" },
];

export { languages, defaultLanguage, locales };
