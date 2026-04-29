import { getAuthToken } from "../auth/session";

export type ApiFieldErrors = Record<string, string[]>;

export type ApiError = {
  status: number;
  message: string;
  fieldErrors?: ApiFieldErrors;
};

const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL ?? "";

const isPlainObject = (value: unknown): value is Record<string, unknown> =>
  typeof value === "object" && value !== null && !Array.isArray(value);

const parseJsonSafe = async (response: Response): Promise<unknown> => {
  try {
    return await response.json();
  } catch {
    return null;
  }
};

const normalizeFieldErrors = (data: unknown): ApiFieldErrors | undefined => {
  if (!isPlainObject(data) || !isPlainObject(data.errors)) {
    return undefined;
  }

  const fieldErrors: ApiFieldErrors = {};
  for (const [key, value] of Object.entries(data.errors)) {
    if (Array.isArray(value)) {
      fieldErrors[key] = value
        .map((entry) => (typeof entry === "string" ? entry : "Invalid value"))
        .filter(Boolean);
    } else if (typeof value === "string") {
      fieldErrors[key] = [value];
    }
  }

  return Object.keys(fieldErrors).length > 0 ? fieldErrors : undefined;
};

const normalizeApiError = (status: number, data: unknown): ApiError => {
  const message =
    isPlainObject(data) && typeof data.message === "string"
      ? data.message
      : `Request failed with status ${status}.`;

  return {
    status,
    message,
    fieldErrors: normalizeFieldErrors(data),
  };
};

export const isApiError = (error: unknown): error is ApiError =>
  isPlainObject(error) &&
  typeof error.status === "number" &&
  typeof error.message === "string";

type ApiRequestOptions = Omit<RequestInit, "body" | "headers"> & {
  body?: unknown;
  headers?: HeadersInit;
};

export const apiFetch = async <T>(
  path: string,
  options: ApiRequestOptions = {}
): Promise<T> => {
  if (!API_BASE) {
    throw {
      status: 0,
      message: "API base URL is not configured.",
    } satisfies ApiError;
  }

  const url = path.startsWith("http")
    ? path
    : `${API_BASE}${path.startsWith("/") ? "" : "/"}${path}`;

  const token = getAuthToken();
  const headers: Record<string, string> = {};

  if (options.body !== undefined) {
    headers["Content-Type"] = "application/json";
  }

  if (token) {
    headers.Authorization = `Bearer ${token}`;
  }

  const response = await fetch(url, {
    ...options,
    headers: {
      ...headers,
      ...(options.headers || {}),
    },
    body:
      options.body !== undefined ? JSON.stringify(options.body) : undefined,
    credentials: "include",
  });

  const data = await parseJsonSafe(response);

  if (!response.ok) {
    throw normalizeApiError(response.status, data);
  }

  return data as T;
};
