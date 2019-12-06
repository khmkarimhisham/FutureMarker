package compiler_api;

import java.io.*;
import org.json.simple.JSONObject;

public class compileTest {

    @SuppressWarnings("unchecked")
    public static JSONObject compileCode(String fileName) {
        boolean build = true;
        String error = "";
        try {
            Process p = Runtime.getRuntime().exec("javac " + fileName);
            p.waitFor();
            BufferedReader errorReader = new BufferedReader(new InputStreamReader(p.getErrorStream()));

            if (errorReader.ready()) {
                build = false;
                String line = null;
                while ((line = errorReader.readLine()) != null) {
                    error += line + "\n";
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        JSONObject result = new JSONObject();
        result.put("build", build);
        result.put("error", error);
        return result;

    }
}
