import { languages, defaultLanguage } from "@/constants/languages";
import { defineRouting } from "next-intl/routing";

export const routing = defineRouting({
  locales: languages,
  defaultLocale: defaultLanguage,
  localeCookie: true,
  localeDetection: true,
});
