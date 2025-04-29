import { routes } from '@constants/site';
import { env } from '@lib/env';

import type { MetadataRoute } from "next";
export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const staticRoutes = routes.map((route: string) => {
    const normalizedRoute = `${route.replace(/^\/|\/$/g, "")}`;
    return {
      url: new URL(
        normalizedRoute.replace(/\/+$/, ""),
        env.SITE_URL
      ).toString(),
      lastModified: new Date("2025-04-29T00:00:00Z").toISOString(),
    };
  });

  return [...staticRoutes];
}
