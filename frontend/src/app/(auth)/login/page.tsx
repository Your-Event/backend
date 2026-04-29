import AuthShell from "@/components/auth/AuthShell";
import LoginForm from "@/components/forms/LoginForm";

export default function LoginPage() {
  return (
    <AuthShell title="Sign in" subtitle="Welcome back. Please enter your details.">
      <LoginForm />
    </AuthShell>
  );
}
