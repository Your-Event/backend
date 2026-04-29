import { apiFetch } from "../api/client";
import { authMeResponseSchema } from "../api/schemas";
import type { AuthMeResponse } from "../api/types";

let authToken: string | null = null;

export const getAuthToken = (): string | null => {
  if (authToken) {
    return authToken;
  }

  if (typeof window === "undefined") {
    return null;
  }

  const stored = window.localStorage.getItem("yourevent_token");
  authToken = stored;
  return stored;
};

export const setAuthToken = (token?: string | null): void => {
  authToken = token ?? null;

  if (typeof window === "undefined") {
    return;
  }

  if (token) {
    window.localStorage.setItem("yourevent_token", token);
  } else {
    window.localStorage.removeItem("yourevent_token");
  }
};

export const clearAuthToken = (): void => setAuthToken(null);

export const getSessionUser = async (): Promise<AuthMeResponse> => {
  const data = await apiFetch<AuthMeResponse>("/auth/me", {
    method: "GET",
  });
  return authMeResponseSchema.parse(data);
};
