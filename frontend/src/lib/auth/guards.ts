import type { Role } from "../api/types";

type RouterLike = {
  push: (href: string) => void;
  replace?: (href: string) => void;
};

export const getRedirectPathForRole = (role?: Role | null): string => {
  switch (role) {
    case "restaurant":
    case "showman":
      return "/provider";
    case "admin":
      return "/admin";
    case "client":
    default:
      return "/dashboard";
  }
};

export const redirectByRole = (router: RouterLike, role?: Role | null): void => {
  const destination = getRedirectPathForRole(role);
  if (router.replace) {
    router.replace(destination);
  } else {
    router.push(destination);
  }
};
