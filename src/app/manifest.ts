import type { MetadataRoute } from "next";
import { getTranslations } from 'next-intl/server';

export default async function manifest(): Promise<MetadataRoute.Manifest> {
  const t = await getTranslations();
  return {
    name: t("AppName"),
    short_name: t("AppName"),
    description: t("Meta.Description"),
    start_url: "/",
    display: "standalone",
    background_color: "#ffffff",
    theme_color: "#fc3760",
    icons: [
      {
        src: "/favicon/android-chrome-192x192.png",
        sizes: "192x192",
        type: "image/png",
      },
      {
        src: "/favicon/android-chrome-512x512.png",
        sizes: "512x512",
        type: "image/png",
      },
    ],
  };
}
