# Enhanced Transpiler Test Examples

## Test Case 1: Simple Transpilation (No Additional Context Needed)

**Input Code (PHP to JavaScript):**
```php
<?php
function calculateSum($numbers) {
    $sum = 0;
    foreach ($numbers as $number) {
        $sum += $number;
    }
    return $sum;
}

$result = calculateSum([1, 2, 3, 4, 5]);
echo "Sum: " . $result;
?>
```

**Expected Result:** 
- **Additional Context Box:** Empty (no chat needed)
- **Result Box:** Direct transpilation to JavaScript

---

## Test Case 2: Ambiguous Code Requiring Clarification

**Input Code (Python to JavaScript):**
```python
import some_unknown_library

def process_data(data):
    result = some_unknown_library.process(data)
    return result.transform()
```

**Expected Behavior:**
1. **Additional Context Box:** 
   ```
   AI: What is the `some_unknown_library` and what does the `process()` and `transform()` methods do? I need to understand the expected behavior to transpile this correctly.
   ```
2. **User responds in Additional Context Box:**
   ```
   AI: What is the `some_unknown_library` and what does the `process()` and `transform()` methods do? I need to understand the expected behavior to transpile this correctly.
   
   User: some_unknown_library is a data processing library. The process() method takes raw data and returns a DataProcessor object. The transform() method converts the processed data into a standardized format.
   ```
3. **Result Box:** Shows the transpiled JavaScript code

---

## Test Case 3: Insufficient Information After Clarification

**Input Code (Java to Python):**
```java
public class DataProcessor {
    private CustomFramework framework;
    
    public DataProcessor() {
        this.framework = new CustomFramework();
    }
    
    public String processData(String input) {
        return framework.process(input);
    }
}
```

**Expected Behavior:**
1. **Additional Context Box:**
   ```
   AI: What is the CustomFramework class and what does its process() method do?
   ```
2. **User responds:**
   ```
   AI: What is the CustomFramework class and what does its process() method do?
   
   User: I'm not sure about the CustomFramework details.
   ```
3. **Result Box:** 
   ```
   I still don't have enough information to produce a complete code sample. Please consult with a subject matter expert and resubmit with additional details.
   ```

---

## Test Case 4: Complex Code with Additional Context

**Input Code (JavaScript to Python):**
```javascript
const express = require('express');
const app = express();

app.get('/api/users', async (req, res) => {
    try {
        const users = await User.find();
        res.json(users);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
});
```

**Additional Context:** "This is a Node.js Express.js API endpoint. I want to convert it to a Python Flask application. The User model should use SQLAlchemy ORM."

**Expected Result:** 
- **Additional Context Box:** Contains the provided context (no AI questions)
- **Result Box:** Direct transpilation to Python Flask with SQLAlchemy

---

## Test Case 5: Framework-Specific Code

**Input Code (C# to Java):**
```csharp
using System.Linq;

public class DataService
{
    public List<string> GetFilteredData(List<string> data)
    {
        return data.Where(x => x.StartsWith("test"))
                  .Select(x => x.ToUpper())
                  .ToList();
    }
}
```

**Additional Context:** "This uses LINQ for data processing. I need equivalent Java code using Java 8+ Streams API."

**Expected Result:** 
- **Additional Context Box:** Contains the provided context (no AI questions)
- **Result Box:** Direct transpilation to Java using Streams API

---

## How to Test:

1. **Navigate to `/transpiler`**
2. **Paste the test code**
3. **Select source and target languages**
4. **Optionally add context in the Additional Context box**
5. **Click "Transpile code"**
6. **If AI asks for clarification:**
   - Type your response in the Additional Context box
   - Press Ctrl+Enter or click "Submit Clarification"
7. **Observe the final result in the Result Box**

## Key Features to Test:

- ✅ **Additional Context Box** - Chat conversation happens here
- ✅ **Result Box** - Only shows final transpiled code or error message
- ✅ **Chat Interface** - AI questions appear as "AI: [question]"
- ✅ **User Responses** - User responses appear as "User: [response]"
- ✅ **One Clarification Limit** - AI only asks once for more info
- ✅ **Clear Separation** - Chat in context box, final code in result box
- ✅ **Conversation History** - Maintains context throughout the interaction

## Expected Chat Flow in Additional Context Box:

```
AI: What is the CustomFramework class and what does its process() method do?

User: I'm not sure about the CustomFramework details.
```

## Expected Result Box Output:

Either:
```
// Final transpiled code here
function example() {
    // JavaScript code
}
```

Or:
```
I still don't have enough information to produce a complete code sample. Please consult with a subject matter expert and resubmit with additional details.
```

This enhanced transpiler provides a clean separation between the interactive chat (Additional Context Box) and the final output (Result Box)! 